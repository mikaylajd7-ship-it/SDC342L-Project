<?php

require_once __DIR__ . '/../config/auth.php';

requireLogin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Customer Complaint System</title>
</head>
<body>

    <h1>Customer Complaint System</h1>

    <h2>Dashboard</h2>

    <p>
        Welcome,
        <?= htmlspecialchars($_SESSION['name']) ?>!
    </p>

    <p>
        Email:
        <?= htmlspecialchars($_SESSION['email']) ?>
    </p>

    <p>
        Account Type:
        <?= htmlspecialchars($_SESSION['user_type']) ?>
    </p>

    <?php if ($_SESSION['user_type'] === 'employee'): ?>

        <p>
            Employee Role:
            <?= htmlspecialchars($_SESSION['role']) ?>
        </p>

        <?php if ($_SESSION['role'] === 'technician'): ?>
            <h3>Technician Access</h3>
            <p>You can access assigned complaints and technician notes.</p>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'administrator'): ?>
            <h3>Administrator Access</h3>
            <p>You can access administrative functions.</p>
        <?php endif; ?>

    <?php else: ?>

        <h3>Customer Access</h3>
        <p>You can submit and view your complaints.</p>

    <?php endif; ?>

    <p>
        <a href="logout.php">Logout</a>
    </p>

</body>
</html>
