<?php
// Start the session and check if the user is logged in as admin
session_start();

// Check if the user is logged in as admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'admin') {
    header("Location: index.php"); // Redirect to login page if not logged in or not admin
    exit;
}

// Simulate users and categories (in a real app, this would be stored in a database or file)
$users = ["user1", "user2"];
$categories = ["Geography", "History", "Science"];

// Handle form submission to assign category
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_user = $_POST['user'];
    $selected_category = $_POST['category'];

    // Assign the category to the user (store it in session or file)
    $_SESSION['user_categories'][$selected_user][] = $selected_category;
    echo "Category '$selected_category' has been assigned to '$selected_user'.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h2>Admin Panel</h2>
    <form method="POST" action="">
        <label for="user">Select User:</label>
        <select name="user" required>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user); ?>"><?php echo htmlspecialchars($user); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="category">Select Category:</label>
        <select name="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Assign Category</button>
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>