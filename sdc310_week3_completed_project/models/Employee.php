<?php
require_once __DIR__ . '/Database.php';

class Employee
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAll(): array
    {
        return $this->db->query(
            "SELECT employee_id, first_name, last_name, email, role, created_at
             FROM employees ORDER BY employee_id"
        )->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT employee_id, first_name, last_name, email, role, created_at
             FROM employees WHERE employee_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(
        string $firstName,
        string $lastName,
        string $email,
        string $passwordHash,
        string $role
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO employees
             (first_name, last_name, email, password_hash, role)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $firstName, $lastName, $email, $passwordHash, $role
        ]);
    }

    public function update(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $role
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE employees
             SET first_name = ?, last_name = ?, email = ?, role = ?
             WHERE employee_id = ?"
        );
        return $stmt->execute([
            $firstName, $lastName, $email, $role, $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM employees WHERE employee_id = ?"
        );
        return $stmt->execute([$id]);
    }
}
?>
