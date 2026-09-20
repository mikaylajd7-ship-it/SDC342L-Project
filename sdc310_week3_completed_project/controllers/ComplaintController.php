<?php
require_once __DIR__ . '/../models/Complaint.php';

class ComplaintController
{
    private Complaint $model;

    public function __construct()
    {
        $this->model = new Complaint();
    }

    public function index(): array
    {
        return $this->model->getAll();
    }

    public function show(int $id): array|false
    {
        return $this->model->getById($id);
    }

    public function store(
        int $customerId,
        ?int $productServiceId,
        int $complaintTypeId,
        ?int $assignedEmployeeId,
        string $subject,
        string $description,
        string $status = 'submitted',
        string $priority = 'medium'
    ): bool {
        return $this->model->create(
            $customerId,
            $productServiceId,
            $complaintTypeId,
            $assignedEmployeeId,
            $subject,
            $description,
            $status,
            $priority
        );
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
        return $this->model->update(
            $id,
            $productServiceId,
            $complaintTypeId,
            $assignedEmployeeId,
            $subject,
            $description,
            $status,
            $priority
        );
    }

    public function destroy(int $id): bool
    {
        return $this->model->delete($id);
    }
}
?>
