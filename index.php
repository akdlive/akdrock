<?php
// Start the session
session_start();

// Hardcoded user credentials (for demonstration purposes)
$users = [
    "abc" => "abc1", // username => password
    "akd" => "akd1"
];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if (isset($users[$username]) && $users[$username] === $password) {
        // Set session variables for successful login
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect to a user-specific welcome page 
        header("Location: " . $username . ".php"); 
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
    <title>Login Page</title>
    <style>
        /* ... (CSS styles as in the provided HTML) ... */
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
