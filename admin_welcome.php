<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php"); // Redirect to login page if not logged in
    exit;
}

// Mock user data (In a real-world scenario, you would retrieve this from a database)
$users = [
    "user1" => ["geography", "math"],
    "user2" => ["geography"],
    "user3" => ["science", "geography"]
];

// Handle category assignment to users
$message = ""; // For displaying any status messages
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $category = $_POST['category'];

    // Validate if the user exists in the $users array
    if (array_key_exists($username, $users)) {
        // Add category to the user
        $users[$username][] = $category;
        $message = "Category '$category' added successfully to '$username'!";
    } else {
        // If the user does not exist in the array
        $message = "User '$username' not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Welcome</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <p>You are logged in as <?php echo htmlspecialchars($_SESSION['admin_username']); ?>.</p>
    <a href="admin_logout.php">Logout</a>

    <h3>Manage Categories</h3>

    <!-- Display any message -->
    <?php if ($message): ?>
        <p style="color:<?php echo (strpos($message, 'not found') !== false) ? 'red' : 'green'; ?>;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" required><br><br>

        <button type="submit">Add Category</button>
    </form>

    <h3>Users and their Categories</h3>
    <ul>
        <?php foreach ($users as $username => $categories): ?>
            <li><?php echo $username . ": " . implode(", ", $categories); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>