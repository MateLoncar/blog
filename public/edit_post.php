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

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
}

$post = $postModel->getPostById($_GET['id']);

if (!$post || $post['user_id'] != $_SESSION['user']['id']) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($postModel->updatePost($_GET['id'], $title, $content)) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error while updating post.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Edit post</h1>
    <form method="POST" action="edit_post.php?id=<?php echo $post['id']; ?>">
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        <div class="form-group">
            <label>Content:</label>
            <textarea name="content" class="form-control" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Save</button>
    </form>
    <br>
    <a href="dashboard.php" class="btn btn-primary">Dashboard</a>
</div>
</body>
</html>
