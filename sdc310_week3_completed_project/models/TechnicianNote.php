<?php
require_once __DIR__ . '/Database.php';

class TechnicianNote
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getByComplaint(int $complaintId): array
    {
        $stmt = $this->db->prepare(
            "SELECT n.note_id, n.complaint_id, n.employee_id,
                    n.note_text, n.created_at,
                    CONCAT(e.first_name, ' ', e.last_name) AS employee_name
             FROM technician_notes n
             INNER JOIN employees e ON n.employee_id = e.employee_id
             WHERE n.complaint_id = ?
             ORDER BY n.created_at"
        );
        $stmt->execute([$complaintId]);
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM technician_notes WHERE note_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(
        int $complaintId,
        int $employeeId,
        string $noteText
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO technician_notes
             (complaint_id, employee_id, note_text)
             VALUES (?, ?, ?)"
        );
        return $stmt->execute([
            $complaintId, $employeeId, $noteText
        ]);
    }

    public function update(int $id, string $noteText): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE technician_notes
             SET note_text = ?
             WHERE note_id = ?"
        );
        return $stmt->execute([$noteText, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM technician_notes WHERE note_id = ?"
        );
        return $stmt->execute([$id]);
    }
}
?>
