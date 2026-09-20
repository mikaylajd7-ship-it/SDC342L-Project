<?php
require_once __DIR__ . '/../models/Employee.php';

class EmployeeController
{
    private Employee $model;

    public function __construct()
    {
        $this->model = new Employee();
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
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $role
    ): bool {
        return $this->model->create(
            $firstName,
            $lastName,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $role
        );
    }

    public function update(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $role
    ): bool {
        return $this->model->update($id, $firstName, $lastName, $email, $role);
    }

    public function destroy(int $id): bool
    {
        return $this->model->delete($id);
    }
}
?>
