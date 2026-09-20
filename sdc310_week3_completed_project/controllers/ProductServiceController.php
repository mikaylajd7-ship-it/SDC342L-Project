<?php
require_once __DIR__ . '/../models/ProductService.php';

class ProductServiceController
{
    private ProductService $model;

    public function __construct()
    {
        $this->model = new ProductService();
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
        string $name,
        string $description,
        string $itemType,
        int $active = 1
    ): bool {
        return $this->model->create($name, $description, $itemType, $active);
    }

    public function update(
        int $id,
        string $name,
        string $description,
        string $itemType,
        int $active
    ): bool {
        return $this->model->update(
            $id, $name, $description, $itemType, $active
        );
    }

    public function destroy(int $id): bool
    {
        return $this->model->delete($id);
    }
}
?>
