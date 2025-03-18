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
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = $auth->login($username, $password);

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username']
        ];
        unset($_SESSION['message']);
        session_write_close();
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = 'Invalid username or password.';
        session_write_close();
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
        <h1 class="page-header text-center">LOGIN</h1>
        <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Login
                            </h3>
                        </div>
                        <div class="panel-body">
                                <form method="POST" action="login.php">
                                <fieldset>
                                        <div class="form-group">
                                        <input class="form-control" placeholder="Username" type="text" name="username" autofocus required>
                                        </div>
                                        <div class="form-group">
                                        <input class="form-control" placeholder="Password" type="password" name="password" required>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                                </fieldset>
                                </form>
                        </div>
                    </div>
                    <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-info text-center">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']); 
            }
            ?>
             <div class="text-center">
                <a href="register.php" class="btn btn-lg btn-success">
                    <span class="glyphicon glyphicon-user"></span> Register
                </a>
            </div>
                </div>
        </div>
</div>
</body>
</html>