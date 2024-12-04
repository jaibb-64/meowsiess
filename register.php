<?php
session_start();

// File to store user data
$userFile = 'users.txt';

// Handle form submission for registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if file exists, otherwise create it
    if (!file_exists($userFile)) {
        file_put_contents($userFile, '');
    }

    // Read existing users
    $users = json_decode(file_get_contents($userFile), true) ?? [];

    // Check if username already exists
    if (array_key_exists($username, $users)) {
        echo "Sorry bud, that username is already taken. Please choose another one ^0^.";
    } else {
        // Add new user
        $users[$username] = $password;

        // Save back to the file
        file_put_contents($userFile, json_encode($users));

        // Redirect to login page
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="customreg.css"/>
    <title>Register for Meowies Journal</title>
</head>
<body>
    <div class = "reg">
    <h1>Greetings newbie, create a new account here ^3^</h1>
    <img src="thelogo.png" alt="Cat logo" width="300" height="300">
    <form action="register.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        
        <input type="submit" value="Register">
    </form>

    <p>Already a meowsie? <a href="login.php">Login here :33</a></p>
    </div>
</body>
</html>
