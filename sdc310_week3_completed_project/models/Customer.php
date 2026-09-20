<?php
require_once __DIR__ . '/Database.php';

class Customer
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAll(): array
    {
        return $this->db->query(
            "SELECT customer_id, first_name, last_name, email, phone, created_at
             FROM customers ORDER BY customer_id"
        )->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT customer_id, first_name, last_name, email, phone, created_at
             FROM customers WHERE customer_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        string $passwordHash
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO customers
             (first_name, last_name, email, phone, password_hash)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $firstName, $lastName, $email, $phone, $passwordHash
        ]);
    }

    public function update(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $phone
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE customers
             SET first_name = ?, last_name = ?, email = ?, phone = ?
             WHERE customer_id = ?"
        );
        return $stmt->execute([
            $firstName, $lastName, $email, $phone, $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM customers WHERE customer_id = ?"
        );
        return $stmt->execute([$id]);
    }
}
?>
