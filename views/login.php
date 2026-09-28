<?php

require_once __DIR__ . '/../config/auth.php';

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit;
}

$error = $error ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Customer Complaint System</title>
</head>
<body>

    <h1>Customer Complaint System</h1>

    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="../controllers/AuthController.php">
        <label for="email">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            required
        >

        <br><br>

        <label for="password">Password:</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <br><br>

        <button type="submit">Login</button>
    </form>

    <p>
        Enter your account email and password to access the system.
    </p>

</body>
</html>
