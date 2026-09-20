<?php
require_once __DIR__ . '/Database.php';

class ProductService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAll(): array
    {
        return $this->db->query(
            "SELECT product_service_id, name, description, item_type, active, created_at
             FROM products_services ORDER BY product_service_id"
        )->fetchAll();
    }

    public function getActive(): array
    {
        return $this->db->query(
            "SELECT product_service_id, name, description, item_type, active, created_at
             FROM products_services WHERE active = 1 ORDER BY name"
        )->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT product_service_id, name, description, item_type, active, created_at
             FROM products_services WHERE product_service_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(
        string $name,
        string $description,
        string $itemType,
        int $active = 1
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO products_services
             (name, description, item_type, active)
             VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $name, $description, $itemType, $active
        ]);
    }

    public function update(
        int $id,
        string $name,
        string $description,
        string $itemType,
        int $active
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE products_services
             SET name = ?, description = ?, item_type = ?, active = ?
             WHERE product_service_id = ?"
        );
        return $stmt->execute([
            $name, $description, $itemType, $active, $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM products_services WHERE product_service_id = ?"
        );
        return $stmt->execute([$id]);
    }
}
?>
