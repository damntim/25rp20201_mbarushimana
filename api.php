<?php
declare(strict_types=1);

header('Content-Type: application/json');

require_once __DIR__ . '/Patient.php';

$action = (string)($_GET['action'] ?? 'list');

try {
    switch ($action) {
        case 'add':
            $contentType = $_SERVER['CONTENT_TYPE'] ?? $_SERVER['HTTP_CONTENT_TYPE'] ?? '';
            if (stripos($contentType, 'application/json') !== false) {
                $payload = json_decode(file_get_contents('php://input') ?: '{}', true) ?? [];
            } else {
                $payload = $_POST;
            }

            $patient = Patient::add([
                'name' => $payload['name'] ?? '',
                'age' => $payload['age'] ?? '',
                'email' => $payload['email'] ?? '',
                'condition' => $payload['condition'] ?? '',
            ]);

            echo json_encode(['success' => true, 'patient' => $patient]);
            break;

        case 'get':
            $id = (string)($_GET['id'] ?? '');
            if ($id === '') {
                http_response_code(400);
                echo json_encode(['error' => 'Missing id']);
                break;
            }
            $found = Patient::find($id);
            if ($found === null) {
                http_response_code(404);
                echo json_encode(['error' => 'Not found']);
                break;
            }
            echo json_encode(['patient' => $found]);
            break;

        case 'list':
        default:
            echo json_encode(['patients' => Patient::all()]);
            break;
    }
} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error']);
}