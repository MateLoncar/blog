<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Post;
use App\Config\Database;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$db = new Database();
$conn = $db->connect();
$postModel = new Post($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $userId = $_SESSION['user']['id'];

    if ($postModel->createPost($userId, $title, $content)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error while creating post.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New post</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Create new post</h1>
    <form method="POST" action="create_post.php">
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Content:</label>
            <textarea name="content" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Publish</button>
    </form>
    <br>
    <a href="dashboard.php" class="btn btn-primary">Back to dashboard</a>
</div>
</body>
</html>
