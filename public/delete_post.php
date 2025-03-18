<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Post;
use App\Config\Database;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
}

$db = new Database();
$conn = $db->connect();
$postModel = new Post($conn);

$post = $postModel->getPostById($_GET['id']);

if (!$post || $post['user_id'] != $_SESSION['user']['id']) {
    header('Location: dashboard.php');
    exit();
}

if ($postModel->deletePost($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
} else {
    echo "Error while deleting post.";
}
?>
