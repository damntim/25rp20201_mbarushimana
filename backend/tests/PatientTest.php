<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PatientTest extends TestCase
{
    private PDO $db;

    protected function setUp(): void
    {
        $this->db = new PDO('sqlite::memory:');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->db->exec(
            'CREATE TABLE patients (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                age INTEGER NOT NULL,
                email TEXT NOT NULL,
                `condition` TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            )'
        );
    }

    public function testCreateThrowsOnInvalidData(): void
    {
        $patient = new Patient($this->db);

        $this->expectException(InvalidArgumentException::class);
        $patient->create([
            'name' => '',
            'age' => 0,
            'email' => '',
            'condition' => ''
        ]);
    }

    public function testCreateAndFind(): void
    {
        $patient = new Patient($this->db);

        $id = $patient->create([
            'name' => 'Alice',
            'age' => 25,
            'email' => 'alice@example.com',
            'condition' => 'Flu'
        ]);

        $this->assertGreaterThan(0, $id);

        $row = $patient->find($id);
        $this->assertNotNull($row);
        $this->assertSame('Alice', $row['name']);
        $this->assertSame(25, (int)$row['age']);
        $this->assertSame('alice@example.com', $row['email']);
        $this->assertSame('Flu', $row['condition']);
    }
}
