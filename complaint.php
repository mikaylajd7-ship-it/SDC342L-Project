<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Complaint</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Submit a Complaint</h1></header>
<main class="container">
    <form action="#" method="post">
        <label for="subject">Subject</label>
        <input id="subject" name="subject" type="text" required>

        <label for="complaint_type">Complaint Type</label>
        <select id="complaint_type" name="complaint_type" required>
            <option value="">Select a type</option>
            <option>Product Issue</option>
            <option>Service Issue</option>
            <option>Billing Issue</option>
            <option>Technical Support</option>
            <option>Other</option>
        </select>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="6" required></textarea>

        <button type="submit">Submit Complaint</button>
    </form>
    <p><a href="../index.php">Return Home</a></p>
</main>
</body>
</html>
