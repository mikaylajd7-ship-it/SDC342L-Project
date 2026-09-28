<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header("Location: ../views/login.php");
        exit;
    }
}

function requireEmployee()
{
    requireLogin();

    if ($_SESSION['user_type'] !== 'employee') {
        http_response_code(403);
        echo "Access Denied. Employee access is required.";
        exit;
    }
}

function requireRole($role)
{
    requireEmployee();

    if ($_SESSION['role'] !== $role) {
        http_response_code(403);
        echo "Access Denied. You do not have permission to access this page.";
        exit;
    }
}

function logoutUser()
{
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}
