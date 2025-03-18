<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Post;
use App\Config\Database;

$db = new Database();
$conn = $db->connect();
$postModel = new Post($conn);
$posts = $postModel->getAllPosts();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">    <!-- Navigacija -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Blog</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="dashboard.php"><strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong></a></li>
                    <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn btn-primary">Login</a></li>
                    <li><a href="register.php" class="btn btn-success">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <hr>

    <!-- Prikaz svih postova -->
    <h2 class="text-center">All Posts</h2>
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                    </div>
                    <div class="panel-body">
                        <p><?php echo htmlspecialchars(substr($post['content'], 0, 100)); ?>...</p>
                    </div>
                    <div class="panel-footer">
                        Author: <?php echo htmlspecialchars($post['author']); ?> | Date: <?php echo $post['created_at']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
