<?php
declare(strict_types=1);

define('DATA_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'data');
define('DATA_FILE', DATA_DIR . DIRECTORY_SEPARATOR . 'patients.json');

function ensureStorage(): void {
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0777, true);
    }
    if (!file_exists(DATA_FILE)) {
        file_put_contents(DATA_FILE, json_encode(['patients' => []], JSON_PRETTY_PRINT));
        chmod(DATA_FILE, 0777);
    }
}

ensureStorage();