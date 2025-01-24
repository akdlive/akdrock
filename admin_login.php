<?php
// Start session
session_start();

// Hardcoded admin credentials
$admin_credentials = [
    "admin" => "adminpass123" // username => password
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if (isset($admin_credentials[$username]) && $admin_credentials[$username] === $password) {
        // Set session variables for admin login
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_username'] = $username;

        // Redirect to admin welcome page
        header("Location: admin_welcome.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>