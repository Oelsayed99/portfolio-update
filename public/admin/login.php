<?php
require_once 'auth.php';

use app\models\User;

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = User::findByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_user_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: /admin/dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; background: #f0f2f5; }
        .login-card { width: 100%; max-width: 400px; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-card login-card">
        <h2 style="margin-top:0">Admin Login</h2>
        <?php if ($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="admin-form-group">
                <label>Username</label>
                <input type="text" name="username" class="admin-form-control" required autofocus>
            </div>
            <div class="admin-form-group">
                <label>Password</label>
                <input type="password" name="password" class="admin-form-control" required>
            </div>
            <button type="submit" class="admin-btn admin-btn-primary" style="width:100%">Login</button>
        </form>
        <p style="margin-top:1.5rem; text-align:center; font-size:0.9rem">
            <a href="/admin/forgot-password.php">Forgot Password?</a>
        </p>
    </div>
</body>
</html>
