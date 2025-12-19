<?php

declare(strict_types=1);

namespace PatientManagement\Models;

use InvalidArgumentException;
use PDO;

class Patient
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(array $data): int
    {
        $name = trim((string)($data['name'] ?? ''));
        $age = (int)($data['age'] ?? 0);
        $email = trim((string)($data['email'] ?? ''));
        $condition = trim((string)($data['condition'] ?? ''));

        if ($name === '' || $email === '' || $condition === '' || $age <= 0) {
            throw new InvalidArgumentException('Invalid patient data');
        }

        $stmt = $this->db->prepare(
            'INSERT INTO patients (name, age, email, `condition`) VALUES (:name, :age, :email, :condition)'
        );

        $stmt->execute([
            ':name' => $name,
            ':age' => $age,
            ':email' => $email,
            ':condition' => $condition,
        ]);

        return (int)$this->db->lastInsertId();
    }

    public function all(): array
    {
        $stmt = $this->db->query(
            'SELECT id, name, age, email, `condition`, created_at FROM patients ORDER BY created_at DESC'
        );

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT id, name, age, email, `condition`, created_at FROM patients WHERE id = :id'
        );

        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }
}
