<?php
declare(strict_types=1);

class Patient {
    public int $id;
    public string $name;
    public int $age;
    public string $email;
    public string $condition;

    public function __construct(array $data) {
        $this->name = trim((string)($data['name'] ?? ''));
        $this->age = (int)($data['age'] ?? 0);
        $this->email = trim((string)($data['email'] ?? ''));
        $this->condition = trim((string)($data['condition'] ?? ''));
    }

    public function validate(): array {
        $errors = [];
        if ($this->name === '') $errors[] = 'Name is required.';
        if ($this->age < 0 || $this->age > 150) $errors[] = 'Age must be between 0 and 150.';
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email.';
        if ($this->condition === '') $errors[] = 'Condition is required.';
        return $errors;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email,
            'condition' => $this->condition,
        ];
    }
}