<?php
require_once 'layout.php';

use app\models\Technology;

$msg = '';
$err = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    Technology::delete($id);
    $msg = 'Technology deleted successfully.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_tech'])) {
    try {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $data = [
            'name' => $_POST['name'] ?? '',
            'icon' => $_POST['icon'] ?? '',
            'color' => $_POST['color'] ?? '',
            'category' => $_POST['category'] ?? 'backend'
        ];

        if ($id) {
            Technology::update($id, $data);
            $msg = 'Technology updated successfully.';
        } else {
            Technology::create($data);
            $msg = 'Technology created successfully.';
        }
    } catch (Exception $e) {
        $err = $e->getMessage();
    }
}

$editTech = null;
if (isset($_GET['edit'])) {
    $editTech = Technology::find((int)$_GET['edit']);
}

$techs = Technology::all();
admin_header("Technology Manager", "technologies");
?>

<?php if ($msg): ?>
    <div style="padding:1rem; background:rgba(34,197,94,0.15); color:var(--admin-success); border:1px solid var(--admin-success); border-radius:8px; margin-bottom:1.5rem;"><?= $msg ?></div>
<?php endif; ?>

<div class="admin-two-col-layout">
    <!-- Form -->
    <div class="admin-card">
        <h3><?= $editTech ? 'Edit Technology' : 'Add New Tech' ?></h3>
        <form method="POST">
            <?php if ($editTech): ?>
                <input type="hidden" name="id" value="<?= $editTech['id'] ?>">
            <?php endif; ?>
            
            <div class="admin-form-group">
                <label>Tech Name</label>
                <input type="text" name="name" class="admin-form-control" value="<?= htmlspecialchars($editTech['name'] ?? '') ?>" required>
            </div>
            
            <div class="admin-form-group">
                <label>FontAwesome Icon Class</label>
                <input type="text" name="icon" class="admin-form-control" value="<?= htmlspecialchars($editTech['icon'] ?? 'fab fa-php') ?>" required>
            </div>

            <div class="admin-form-group">
                <label>Hex Color</label>
                <input type="text" name="color" class="admin-form-control" value="<?= htmlspecialchars($editTech['color'] ?? '#777bb4') ?>" required>
            </div>

            <div class="admin-form-group">
                <label>Category</label>
                <select name="category" class="admin-form-control">
                    <option value="frontend" <?= ($editTech['category'] ?? '') === 'frontend' ? 'selected' : '' ?>>Frontend</option>
                    <option value="backend" <?= ($editTech['category'] ?? '') === 'backend' ? 'selected' : '' ?>>Backend</option>
                    <option value="database" <?= ($editTech['category'] ?? '') === 'database' ? 'selected' : '' ?>>Database</option>
                    <option value="devops" <?= ($editTech['category'] ?? '') === 'devops' ? 'selected' : '' ?>>DevOps</option>
                    <option value="tools" <?= ($editTech['category'] ?? '') === 'tools' ? 'selected' : '' ?>>Tools</option>
                </select>
            </div>

            <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
                <?php if ($editTech): ?>
                    <a href="/admin/technologies.php" class="admin-btn admin-btn-secondary" style="flex-grow:1; text-align:center;">Cancel</a>
                <?php endif; ?>
                <button type="submit" name="save_tech" class="admin-btn admin-btn-primary" style="flex-grow:2;">Save</button>
            </div>
        </form>
    </div>

    <!-- Listing -->
    <div class="admin-card">
        <h3>Registered Technologies</h3>
        <div class="admin-table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($techs as $t): ?>
                        <tr>
                            <td>
                                <i class="<?= $t['icon'] ?>" style="font-size:1.5rem; color:<?= $t['color'] ?>"></i>
                            </td>
                            <td><strong><?= htmlspecialchars($t['name']) ?></strong></td>
                            <td><span class="admin-badge admin-badge-primary"><?= htmlspecialchars($t['category']) ?></span></td>
                            <td><span style="font-family:monospace; color:<?= $t['color'] ?>;"><?= htmlspecialchars($t['color']) ?></span></td>
                            <td>
                                <div class="listing-actions-cell">
                                    <a href="?edit=<?= $t['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem;"><i class="fas fa-edit"></i></a>
                                    <a href="?delete=<?= $t['id'] ?>" class="admin-btn admin-btn-danger" style="padding:0.4rem; font-size:0.8rem;" onclick="return confirm('Delete technology?')"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
admin_footer();
?>
