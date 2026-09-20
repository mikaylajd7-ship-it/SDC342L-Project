<?php
require_once __DIR__ . '/../models/ComplaintType.php';

class ComplaintTypeController
{
    private ComplaintType $model;

    public function __construct()
    {
        $this->model = new ComplaintType();
    }

    public function index(): array
    {
        return $this->model->getAll();
    }

    public function active(): array
    {
        return $this->model->getActive();
    }

    public function show(int $id): array|false
    {
        return $this->model->getById($id);
    }

    public function store(
        string $typeName,
        string $description,
        int $active = 1
    ): bool {
        return $this->model->create($typeName, $description, $active);
    }

    public function update(
        int $id,
        string $typeName,
        string $description,
        int $active
    ): bool {
        return $this->model->update(
            $id, $typeName, $description, $active
        );
    }

    public function destroy(int $id): bool
    {
        return $this->model->delete($id);
    }
}
?>
