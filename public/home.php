<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php'); // Ako nije prijavljen, vrati ga na login
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
