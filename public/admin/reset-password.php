<?php
require_once 'auth.php';

use app\models\User;

$token = $_GET['token'] ?? '';
$error = '';
$success = false;

if (!$token) {
    die("Token missing.");
}

$user = User::findByToken($token);

if (!$user) {
    $error = "Invalid or expired token.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($password === $confirm) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        User::updatePassword($user['id'], $hashed);
        $success = true;
    } else {
        $error = "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; background: #f0f2f5; }
        .login-card { width: 100%; max-width: 400px; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-card login-card">
        <h2 style="margin-top:0">Reset Password</h2>
        
        <?php if ($success): ?>
            <p style="color:green">Password has been reset successfully. <a href="/admin/login.php">Login here</a></p>
        <?php else: ?>
            <?php if ($error): ?>
                <p style="color:red"><?= $error ?></p>
            <?php endif; ?>

            <?php if ($user): ?>
                <form method="POST">
                    <div class="admin-form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="admin-form-control" required minlength="6">
                    </div>
                    <div class="admin-form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="admin-form-control" required>
                    </div>
                    <button type="submit" class="admin-btn admin-btn-primary" style="width:100%">Reset Password</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
