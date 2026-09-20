<?php
require_once __DIR__ . '/../models/Customer.php';

class CustomerController
{
    private Customer $model;

    public function __construct()
    {
        $this->model = new Customer();
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
        string $phone,
        string $password
    ): bool {
        return $this->model->create(
            $firstName,
            $lastName,
            $email,
            $phone,
            password_hash($password, PASSWORD_DEFAULT)
        );
    }

    public function update(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $phone
    ): bool {
        return $this->model->update($id, $firstName, $lastName, $email, $phone);
    }

    public function destroy(int $id): bool
    {
        return $this->model->delete($id);
    }
}
?>
