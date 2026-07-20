<?php
require_once 'layout.php';

use app\models\User;

$msg = '';
$err = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id !== (int)$_SESSION['admin_user_id']) {
        User::delete($id);
        $msg = 'User deleted successfully.';
    } else {
        $err = 'You cannot delete your own active account.';
    }
}

// Handle Add / Edit Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_user'])) {
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        if ($id) {
            User::updateUser($id, $username, $email, $password);
            if ($id === (int)$_SESSION['admin_user_id']) {
                $_SESSION['admin_username'] = $username;
            }
            $msg = 'User updated successfully.';
        } else {
            if (empty($password)) {
                throw new Exception('Password is required for new users.');
            }
            User::create($username, $email, password_hash($password, PASSWORD_DEFAULT));
            $msg = 'User created successfully.';
        }
    } catch (Exception $e) {
        $err = 'Error saving user: ' . $e->getMessage();
    }
}

// Fetch user for editing if specified
$editUser = null;
if (isset($_GET['edit'])) {
    $editUser = User::findById((int)$_GET['edit']);
}

$users = User::all();

admin_header("User Management", "users");
?>

<?php if ($msg): ?>
    <div style="padding:1rem; background:rgba(34,197,94,0.15); color:var(--admin-success); border:1px solid var(--admin-success); border-radius:8px; margin-bottom:1.5rem;"><?= $msg ?></div>
<?php endif; ?>
<?php if ($err): ?>
    <div style="padding:1rem; background:rgba(239,68,68,0.15); color:var(--admin-danger); border:1px solid var(--admin-danger); border-radius:8px; margin-bottom:1.5rem;"><?= $err ?></div>
<?php endif; ?>

<div class="admin-two-col-layout">
    <!-- Form Card -->
    <div class="admin-card" style="height: fit-content;">
        <h3><?= $editUser ? 'Edit User' : 'Add New User' ?></h3>
        <form method="POST">
            <?php if ($editUser): ?>
                <input type="hidden" name="id" value="<?= $editUser['id'] ?>">
            <?php endif; ?>
            
            <div class="admin-form-group">
                <label>Username</label>
                <input type="text" name="username" class="admin-form-control" value="<?= htmlspecialchars($editUser['username'] ?? '') ?>" required>
            </div>
            
            <div class="admin-form-group">
                <label>Email</label>
                <input type="email" name="email" class="admin-form-control" value="<?= htmlspecialchars($editUser['email'] ?? '') ?>" required>
            </div>

            <div class="admin-form-group">
                <label>Password <?= $editUser ? '<span style="font-size:0.75rem; color:var(--admin-text-muted);">(Leave blank to keep current)</span>' : '' ?></label>
                <input type="password" name="password" class="admin-form-control" <?= $editUser ? '' : 'required' ?>>
            </div>

            <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
                <?php if ($editUser): ?>
                    <a href="/admin/users.php" class="admin-btn admin-btn-secondary" style="flex-grow:1; text-align:center;">Cancel</a>
                <?php endif; ?>
                <button type="submit" name="save_user" class="admin-btn admin-btn-primary" style="flex-grow:2;"><?= $editUser ? 'Update User' : 'Add User' ?></button>
            </div>
        </form>
    </div>

    <!-- Table Listing -->
    <div class="admin-card">
        <h3>Registered Users</h3>
        <div class="admin-table-responsive">
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
                        <td>
                            <strong><?= htmlspecialchars($user['username']) ?></strong>
                            <?php if ((int)$user['id'] === (int)$_SESSION['admin_user_id']): ?>
                                <span class="admin-badge admin-badge-primary" style="margin-left:0.5rem; font-size:0.7rem;">You</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars(date('M d, Y', strtotime($user['created_at']))) ?></td>
                        <td>
                            <div class="listing-actions-cell">
                                <a href="?edit=<?= $user['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem;" title="Edit User"><i class="fas fa-edit"></i> Edit</a>
                                <?php if ((int)$user['id'] !== (int)$_SESSION['admin_user_id']): ?>
                                    <a href="?delete=<?= $user['id'] ?>" class="admin-btn admin-btn-danger" style="padding:0.4rem; font-size:0.8rem;" onclick="return confirm('Delete user account?')"><i class="fas fa-trash"></i> Delete</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php admin_footer(); ?>
