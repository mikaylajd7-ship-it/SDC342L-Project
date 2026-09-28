<?php

require_once __DIR__ . '/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function findCustomerByEmail($email)
    {
        $sql = "SELECT * FROM customers WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findEmployeeByEmail($email)
    {
        $sql = "SELECT * FROM employees WHERE email = :email LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function authenticate($email, $password)
    {
        $customer = $this->findCustomerByEmail($email);

        if ($customer && password_verify($password, $customer['password_hash'])) {
            return [
                'user_id' => $customer['customer_id'],
                'user_type' => 'customer',
                'role' => null,
                'name' => $customer['first_name'] . ' ' . $customer['last_name'],
                'email' => $customer['email']
            ];
        }

        $employee = $this->findEmployeeByEmail($email);

        if ($employee && password_verify($password, $employee['password_hash'])) {
            return [
                'user_id' => $employee['employee_id'],
                'user_type' => 'employee',
                'role' => $employee['role'],
                'name' => $employee['first_name'] . ' ' . $employee['last_name'],
                'email' => $employee['email']
            ];
        }

        return false;
    }
}
