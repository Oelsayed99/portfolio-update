<?php
require_once 'auth.php';
require_once dirname(__DIR__, 2) . '/app/helpers.php';

use app\models\User;

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    
    $user = User::findByEmail($email);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        User::setResetToken($user['id'], $token, $expiry);

        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $reset_link = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/admin/reset-password.php?token=" . $token;
        
        send_reset_email($email, $reset_link);
    }
    
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; background: #f0f2f5; }
        .login-card { width: 100%; max-width: 500px; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-card login-card">
        <h2 style="margin-top:0">Forgot Password</h2>
        
        <?php if ($success): ?>
            <div style="padding:1.5rem; background:#ecfdf5; border:1px solid #10b981; border-radius:8px; margin-bottom:1.5rem; color:#065f46;">
                <p style="margin:0; font-weight:bold;">Request Received</p>
                <p style="margin:0.5rem 0 0 0; font-size:0.95rem;">If an account exists with that email, a password reset link has been sent. Please check your inbox (and spam folder).</p>
            </div>
            <p style="text-align:center; font-size:0.9rem">
                <a href="/admin/login.php" class="admin-btn admin-btn-primary" style="display:inline-block; text-decoration:none; width:auto; padding:0.5rem 2rem;">Return to Login</a>
            </p>
        <?php else: ?>
            <p style="color:#666">Enter your email to receive a password reset link.</p>
            
            <?php if ($error): ?>
                <p style="color:red"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST">
                <div class="admin-form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="admin-form-control" required autofocus>
                </div>
                <button type="submit" class="admin-btn admin-btn-primary" style="width:100%">Send Reset Link</button>
            </form>
            <p style="margin-top:1.5rem; text-align:center; font-size:0.9rem">
                <a href="/admin/login.php">&larr; Back to Login</a>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>

