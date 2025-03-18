<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../vendor/autoload.php';
use App\Models\Post;
use App\Config\Database;

$db = new Database();
$conn = $db->connect();
$postModel = new Post($conn);
$posts = $postModel->getAllPostsByUser($_SESSION['user']['id']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Welcome, <?php echo $_SESSION['user']['username']; ?>!</h1>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <a href="index.php" class="btn btn-primary">Home</a>
    <a href="create_post.php" class="btn btn-success">New Post</a>

    <h2>Your posts</h2>
    <?php foreach ($posts as $post): ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo htmlspecialchars($post['title']); ?></h3>
            </div>
            <div class="panel-body">
                <p><?php echo htmlspecialchars(substr($post['content'], 0, 100)); ?>...</p>
                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-warning">Edit</a>
                <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
