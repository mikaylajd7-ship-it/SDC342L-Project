<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Customer Registration</h1></header>
<main class="container">
    <form action="#" method="post">
        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" type="text" required>

        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" type="text" required>

        <label for="email">Email</label>
        <input id="email" name="email" type="email" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>

        <button type="submit">Register</button>
    </form>
    <p><a href="../index.php">Return Home</a></p>
</main>
</body>
</html>
