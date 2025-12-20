<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

class Patient
{
    public static function all(): array
    {
        $db = self::readDb();
        return $db['patients'];
    }

    public static function find(string $id): ?array
    {
        $db = self::readDb();
        foreach ($db['patients'] as $p) {
            if ((string)($p['id'] ?? '') === (string)$id) {
                return $p;
            }
        }
        return null;
    }

    public static function add(array $data): array
    {
        $name = trim((string)($data['name'] ?? ''));
        $age = (int)($data['age'] ?? 0);
        $email = trim((string)($data['email'] ?? ''));
        $condition = trim((string)($data['condition'] ?? ''));

        if ($name === '' || $age <= 0 || !filter_var($email, FILTER_VALIDATE_EMAIL) || $condition === '') {
            throw new InvalidArgumentException('Invalid patient data.');
        }

        $db = self::readDb();
        $id = self::nextId($db);

        $patient = [
            'id' => (string)$id,
            'name' => $name,
            'age' => $age,
            'email' => $email,
            'condition' => $condition,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $db['patients'][] = $patient;
        self::writeDb($db);

        return $patient;
    }

    private static function readDb(): array
    {
        $path = DATA_FILE;

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        if (!file_exists($path)) {
            $initial = json_encode(['patients' => []], JSON_PRETTY_PRINT);
            file_put_contents($path, $initial);
        }

        $fp = fopen($path, 'r');
        if ($fp === false) {
            return ['patients' => []];
        }

        flock($fp, LOCK_SH);
        $contents = stream_get_contents($fp) ?: '';
        flock($fp, LOCK_UN);
        fclose($fp);

        $decoded = json_decode($contents, true);
        if (!is_array($decoded) || !isset($decoded['patients']) || !is_array($decoded['patients'])) {
            return ['patients' => []];
        }

        return $decoded;
    }

    private static function writeDb(array $db): void
    {
        $path = DATA_FILE;
        $fp = fopen($path, 'c+');
        if ($fp === false) {
            throw new RuntimeException('Unable to open data file.');
        }

        flock($fp, LOCK_EX);
        ftruncate($fp, 0);
        rewind($fp);
        $bytes = fwrite($fp, json_encode($db, JSON_PRETTY_PRINT));
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);

        if ($bytes === false) {
            throw new RuntimeException('Failed to write data.');
        }
    }

    private static function nextId(array $db): string
    {
        $max = 0;
        foreach ($db['patients'] as $p) {
            $n = (int)($p['id'] ?? 0);
            if ($n > $max) {
                $max = $n;
            }
        }
        return (string)($max + 1);
    }
}