<?php
require_once 'auth.php';
auth_required();

use app\models\User;

$msg = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id !== (int)$_SESSION['admin_user_id']) {
        User::delete($id);
        $msg = 'User deleted successfully.';
    } else {
        $msg = 'You cannot delete yourself.';
    }
}

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    try {
        User::create($username, $email, $password);
        $msg = 'User added successfully.';
    } catch (Exception $e) {
        $msg = 'Error adding user: ' . $e->getMessage();
    }
}

$users = User::all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-container">
        <header class="admin-header">
            <h1>User Management</h1>
            <a href="/admin/dashboard.php" class="admin-btn">Back to Dashboard</a>
        </header>

        <?php if ($msg): ?>
            <p style="padding:1rem; background:#dcfce7; color:#166534; border-radius:8px;"><?= $msg ?></p>
        <?php endif; ?>

        <div class="admin-card">
            <h3>Add New User</h3>
            <form method="POST" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 1rem; align-items: end;">
                <div class="admin-form-group" style="margin:0">
                    <label>Username</label>
                    <input type="text" name="username" class="admin-form-control" required>
                </div>
                <div class="admin-form-group" style="margin:0">
                    <label>Email</label>
                    <input type="email" name="email" class="admin-form-control" required>
                </div>
                <div class="admin-form-group" style="margin:0">
                    <label>Password</label>
                    <input type="password" name="password" class="admin-form-control" required>
                </div>
                <button type="submit" name="add_user" class="admin-btn admin-btn-primary">Add User</button>
            </form>
        </div>

        <div class="admin-card">
            <h3>Existing Users</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['created_at'] ?></td>
                        <td>
                            <?php if ($user['id'] !== $_SESSION['admin_user_id']): ?>
                                <a href="?delete=<?= $user['id'] ?>" class="admin-btn admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            <?php else: ?>
                                <span style="color:#999; font-style:italic">Current User</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
