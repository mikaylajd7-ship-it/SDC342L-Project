<?php
require_once __DIR__ . '/Database.php';

class ComplaintType
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAll(): array
    {
        return $this->db->query(
            "SELECT complaint_type_id, type_name, description, active
             FROM complaint_types ORDER BY complaint_type_id"
        )->fetchAll();
    }

    public function getActive(): array
    {
        return $this->db->query(
            "SELECT complaint_type_id, type_name, description, active
             FROM complaint_types WHERE active = 1 ORDER BY type_name"
        )->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT complaint_type_id, type_name, description, active
             FROM complaint_types WHERE complaint_type_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(
        string $typeName,
        string $description,
        int $active = 1
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO complaint_types (type_name, description, active)
             VALUES (?, ?, ?)"
        );
        return $stmt->execute([
            $typeName, $description, $active
        ]);
    }

    public function update(
        int $id,
        string $typeName,
        string $description,
        int $active
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE complaint_types
             SET type_name = ?, description = ?, active = ?
             WHERE complaint_type_id = ?"
        );
        return $stmt->execute([
            $typeName, $description, $active, $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM complaint_types WHERE complaint_type_id = ?"
        );
        return $stmt->execute([$id]);
    }
}
?>
