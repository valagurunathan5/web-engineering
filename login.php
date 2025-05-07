<?php
session_start();

// MySQL connection
$host = "localhost";
$dbname = "movie_booking";
$username_db = "root";      // default in XAMPP
$password_db = "";          // default is empty

$conn = new mysqli($host, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hardcoded login credentials
$valid_username = "user";
$valid_password = "pass123";

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: login.php");
        exit;
    } else {
        $error = "Invalid login credentials.";
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_form']) && isset($_SESSION['username'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO info (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    if ($stmt->execute()) {
        $message = "Form submitted and saved to database!";
    } else {
        $message = "Database error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Login and Save Form</title></head>
<body>
<?php if (!isset($_SESSION['username'])): ?>
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>
<?php else: ?>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>

    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

    <form method="post">
        <h3>Enter Details</h3>
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        <input type="submit" name="user_form" value="Submit">
    </form>

    <p><a href="login.php?logout=true">Logout</a></p>
<?php endif; ?>
</body>
</html>
