<?php
declare(strict_types=1);
header('Content-Type: application/json');

require __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'Patient.php';

$action = (string)($_GET['action'] ?? '');
$method = $_SERVER['REQUEST_METHOD'];

function readPatients(): array {
    $raw = file_get_contents(DATA_FILE);
    $data = json_decode($raw ?: '{"patients":[]}', true);
    return is_array($data) ? $data : ['patients' => []];
}

function writePatients(array $data): bool {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    return (bool)file_put_contents(DATA_FILE, $json);
}

try {
    switch ("$method:$action") {
        case 'GET:list': {
            $data = readPatients();
            echo json_encode($data);
            break;
        }
        case 'GET:get': {
            $id = (int)($_GET['id'] ?? 0);
            $data = readPatients();
            $patient = null;
            foreach ($data['patients'] as $p) {
                if ((int)($p['id'] ?? -1) === $id) {
                    $patient = $p;
                    break;
                }
            }
            if ($patient) {
                echo json_encode(['patient' => $patient]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Patient not found']);
            }
            break;
        }
        case 'POST:add': {
            $payload = json_decode(file_get_contents('php://input'), true);
            if (!is_array($payload)) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid JSON body']);
                break;
            }

            $patient = new Patient($payload);
            $errors = $patient->validate();
            if ($errors) {
                http_response_code(422);
                echo json_encode(['errors' => $errors]);
                break;
            }

            $data = readPatients();
            $nextId = 1;
            if (!empty($data['patients'])) {
                $ids = array_map(fn($p) => (int)$p['id'], $data['patients']);
                $nextId = max($ids) + 1;
            }
            $patient->id = $nextId;

            $data['patients'][] = $patient->toArray();
            if (!writePatients($data)) {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to write data']);
                break;
            }

            echo json_encode(['message' => 'Patient added', 'patient' => $patient->toArray()]);
            break;
        }
        default: {
            http_response_code(400);
            echo json_encode(['error' => 'Unsupported action or method']);
        }
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error', 'details' => $e->getMessage()]);
}