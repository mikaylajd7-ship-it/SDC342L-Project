<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../config/auth.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Please enter your email and password.";
                require __DIR__ . '/../views/login.php';
                return;
            }

            $userModel = new User();
            $user = $userModel->authenticate($email, $password);

            if ($user) {
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];

                header("Location: ../views/dashboard.php");
                exit;
            }

            $error = "Invalid email or password.";
        }

        require __DIR__ . '/../views/login.php';
    }

    public function logout()
    {
        logoutUser();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $controller->login();
}

        header("Location: ../views/login.php");
        exit;
    }
}
