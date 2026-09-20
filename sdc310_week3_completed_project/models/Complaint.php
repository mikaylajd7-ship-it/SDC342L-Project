<?php
require_once __DIR__ . '/Database.php';

class Complaint
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAll(): array
    {
        $sql = "SELECT
                    c.complaint_id,
                    c.customer_id,
                    c.product_service_id,
                    c.complaint_type_id,
                    c.assigned_employee_id,
                    c.subject,
                    c.description,
                    c.status,
                    c.priority,
                    c.created_at,
                    c.updated_at,
                    CONCAT(cu.first_name, ' ', cu.last_name) AS customer_name,
                    ps.name AS product_service_name,
                    ct.type_name AS complaint_type_name,
                    CONCAT(e.first_name, ' ', e.last_name) AS employee_name
                FROM complaints c
                INNER JOIN customers cu
                    ON c.customer_id = cu.customer_id
                INNER JOIN complaint_types ct
                    ON c.complaint_type_id = ct.complaint_type_id
                LEFT JOIN products_services ps
                    ON c.product_service_id = ps.product_service_id
                LEFT JOIN employees e
                    ON c.assigned_employee_id = e.employee_id
                ORDER BY c.complaint_id";

        return $this->db->query($sql)->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM complaints WHERE complaint_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(
        int $customerId,
        ?int $productServiceId,
        int $complaintTypeId,
        ?int $assignedEmployeeId,
        string $subject,
        string $description,
        string $status = 'submitted',
        string $priority = 'medium'
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO complaints
             (customer_id, product_service_id, complaint_type_id,
              assigned_employee_id, subject, description, status, priority)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $customerId,
            $productServiceId ?: null,
            $complaintTypeId,
            $assignedEmployeeId ?: null,
            $subject,
            $description,
            $status,
            $priority
        ]);
    }

    public function update(
        int $id,
        ?int $productServiceId,
        int $complaintTypeId,
        ?int $assignedEmployeeId,
        string $subject,
        string $description,
        string $status,
        string $priority
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE complaints
             SET product_service_id = ?,
                 complaint_type_id = ?,
                 assigned_employee_id = ?,
                 subject = ?,
                 description = ?,
                 status = ?,
                 priority = ?
             WHERE complaint_id = ?"
        );

        return $stmt->execute([
            $productServiceId ?: null,
            $complaintTypeId,
            $assignedEmployeeId ?: null,
            $subject,
            $description,
            $status,
            $priority,
            $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM complaints WHERE complaint_id = ?"
        );
        return $stmt->execute([$id]);
    }
}
?>
