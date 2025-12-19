<?php

declare(strict_types=1);

use PatientManagement\Models\Patient;

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Patient.php';

try {
    $db = db_connection();
    $patients = new Patient($db);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    if ($method === 'GET') {
        $idRaw = $_GET['id'] ?? null;
        if ($idRaw !== null) {
            $id = (int)$idRaw;
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid id']);
                exit;
            }

            $patient = $patients->find($id);
            if ($patient === null) {
                http_response_code(404);
                echo json_encode(['error' => 'Patient not found']);
                exit;
            }

            echo json_encode($patient);
            exit;
        }

        echo json_encode($patients->all());
        exit;
    }

    if ($method === 'POST') {
        $raw = file_get_contents('php://input') ?: '';
        $data = json_decode($raw, true);

        if (!is_array($data)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON body']);
            exit;
        }

        try {
            $id = $patients->create($data);
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        } catch (PDOException $e) {
            if (($e->errorInfo[0] ?? '') === '23000') {
                http_response_code(409);
                echo json_encode(['error' => 'Email already exists']);
                exit;
            }
            throw $e;
        }

        http_response_code(201);
        echo json_encode(['id' => $id]);
        exit;
    }

    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
