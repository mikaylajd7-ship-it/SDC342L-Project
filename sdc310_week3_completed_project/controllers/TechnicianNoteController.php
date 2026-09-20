<?php
require_once __DIR__ . '/../models/TechnicianNote.php';

class TechnicianNoteController
{
    private TechnicianNote $model;

    public function __construct()
    {
        $this->model = new TechnicianNote();
    }

    public function byComplaint(int $complaintId): array
    {
        return $this->model->getByComplaint($complaintId);
    }

    public function show(int $id): array|false
    {
        return $this->model->getById($id);
    }

    public function store(
        int $complaintId,
        int $employeeId,
        string $noteText
    ): bool {
        return $this->model->create(
            $complaintId,
            $employeeId,
            $noteText
        );
    }

    public function update(int $id, string $noteText): bool
    {
        return $this->model->update($id, $noteText);
    }

    public function destroy(int $id): bool
    {
        return $this->model->delete($id);
    }
}
?>
