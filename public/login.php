<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;

if (isset($_SESSION['user'])) {
    header('Location: home.php');
    exit();
}

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']); // trim() uklanja razmake
    $password = trim($_POST['password']);

    $user = $auth->login($username, $password);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username']
        ];
        unset($_SESSION['message']);
        session_write_close();
        header('Location: home.php');
        exit();
    } else {
        $_SESSION['message'] = 'Invalid username or password.';
        session_write_close();
        header('Location: index.php');
        exit();
    }
}
?>
