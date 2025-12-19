<?php
declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

if ($path === '/api/patients.php') {
    require __DIR__ . '/api/patients.php';
    exit;
}

if ($path === '/' || $path === '/index.php') {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'service' => 'patient-backend',
        'status' => 'ok',
        'endpoints' => [
            'GET /api/patients.php',
            'GET /api/patients.php?id=1',
            'POST /api/patients.php'
        ]
    ]);
    exit;
}

http_response_code(404);
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['error' => 'Not Found']);
