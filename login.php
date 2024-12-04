<?php
session_start();

// File to store user data
$userFile = 'users.txt';

// Check if file exists
if (!file_exists($userFile)) {
    echo "No users are registered yet. Please <a href='register.php'>register</a>.";
    exit();
}

// Read users from file
$users = json_decode(file_get_contents($userFile), true) ?? [];

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate credentials
    if (array_key_exists($username, $users) && $users[$username] === $password) {
        // Set session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        // Redirect to journal.php
        header("Location: journal.php");
        exit();
    } else {
        echo "Erm...Invalid username or password. Wanna try that again bud? <a href='login.php'>Try again</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="customlogin.css"/>
    <title>Login to Meowies</title>
</head>
<body>
    <div class = "login-center">
    <h1>~Login to Meowies Journal~</h1>
    <img src="thelogo.png" alt="Cat logo" width="300" height="300">

    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        
        <input type="submit" value="Login">
    </form>

    <p>New in these parts? <a href="register.php">Register here ^3^</a></p>
    </div>
</body>
</html>
