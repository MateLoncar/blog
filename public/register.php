<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\User;
use App\Config\Database;

$db = new Database();
$conn = $db->connect();
$userModel = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($userModel->getUserByUsername($username)) {
        $_SESSION['message'] = "Username already exists.";
        header("Location: register.php");
        exit();
    }

    if ($userModel->register($username, $password)) {
        $_SESSION['message'] = "Registration successful.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['message'] = "An error occurred during registration.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>

    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
