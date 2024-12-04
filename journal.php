<?php 
session_start();

// Check if the user is logged in
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
    header("Location: theactualthing.html");
    exit();
}

// Get username from session
$username = $_SESSION['username'];

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['journal_entry'])) {
    $journalEntry = trim($_POST['journal_entry']);
    $journalEntry = htmlspecialchars($journalEntry, ENT_QUOTES, 'UTF-8'); // Escape special characters

    // Save the entry to a file
    $file = 'journal_entries.txt';
    $entry = date("Y-m-d H:i:s") . " - " . $username . " wrote: " . $journalEntry . PHP_EOL;
    file_put_contents($file, $entry, FILE_APPEND);

    echo "Thanks, " . htmlspecialchars($username) . "! Your entry has been saved. Remember that you're awesome sauce!";
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Meowies Journal</title>
    <link rel="stylesheet" href="customjournal.css"/>
</head>
<body>
    <div class="journal-center">
        <h1>Greetings <?php echo htmlspecialchars($username); ?>!</h1>
        <img src="thelogo.png" alt="Cat logo" width="150" height="150">
        <p>How are we feeling today?</p>
        <form action="journal.php" method="POST">
            <label for="journal_entry">Meowies Journal Entry:</label><br>
            <textarea
                id="journal_entry" 
                name="journal_entry"
                rows="10" 
                cols="50" 
                placeholder="Write your thoughts here..." 
                required>
            </textarea>
            <br>
            <input type="submit" value="Submit Entry">
        </form>
        <form action="logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
