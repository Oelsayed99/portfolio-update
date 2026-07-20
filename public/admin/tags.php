<?php
require_once 'layout.php';

use app\models\Tag;

$msg = '';
$err = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    Tag::delete($id);
    $msg = 'Tag deleted successfully.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_tag'])) {
    try {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        
        $name_en = $_POST['name_en'] ?? '';
        $slug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name_en)));

        $data = [
            'name_en' => $name_en,
            'name_ar' => $_POST['name_ar'] ?? '',
            'slug' => $slug
        ];

        if ($id) {
            Tag::update($id, $data);
            $msg = 'Tag updated successfully.';
        } else {
            Tag::create($data);
            $msg = 'Tag created successfully.';
        }
    } catch (Exception $e) {
        $err = $e->getMessage();
    }
}

$editTag = null;
if (isset($_GET['edit'])) {
    $editTag = Tag::find((int)$_GET['edit']);
}

$tags = Tag::all();
admin_header("Tag Manager", "tags");
?>

<?php if ($msg): ?>
    <div style="padding:1rem; background:rgba(34,197,94,0.15); color:var(--admin-success); border:1px solid var(--admin-success); border-radius:8px; margin-bottom:1.5rem;"><?= $msg ?></div>
<?php endif; ?>

<div class="admin-two-col-layout">
    <!-- Form -->
    <div class="admin-card">
        <h3><?= $editTag ? 'Edit Tag' : 'Add New Tag' ?></h3>
        <form method="POST">
            <?php if ($editTag): ?>
                <input type="hidden" name="id" value="<?= $editTag['id'] ?>">
            <?php endif; ?>
            
            <div class="admin-form-group">
                <label>Tag (English)</label>
                <input type="text" name="name_en" class="admin-form-control" value="<?= htmlspecialchars($editTag['name_en'] ?? '') ?>" required>
            </div>
            
            <div class="admin-form-group">
                <label>Tag (Arabic)</label>
                <input type="text" name="name_ar" class="admin-form-control" value="<?= htmlspecialchars($editTag['name_ar'] ?? '') ?>" required>
            </div>

            <div class="admin-form-group">
                <label>Slug (Optional)</label>
                <input type="text" name="slug" class="admin-form-control" value="<?= htmlspecialchars($editTag['slug'] ?? '') ?>">
            </div>

            <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
                <?php if ($editTag): ?>
                    <a href="/admin/tags.php" class="admin-btn admin-btn-secondary" style="flex-grow:1; text-align:center;">Cancel</a>
                <?php endif; ?>
                <button type="submit" name="save_tag" class="admin-btn admin-btn-primary" style="flex-grow:2;">Save</button>
            </div>
        </form>
    </div>

    <!-- Listing -->
    <div class="admin-card">
        <h3>Registered Tags</h3>
        <div class="admin-table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Tag (EN)</th>
                        <th>Tag (AR)</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tags as $t): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($t['name_en']) ?></strong></td>
                            <td><?= htmlspecialchars($t['name_ar']) ?></td>
                            <td><span style="font-family:monospace;"><?= htmlspecialchars($t['slug']) ?></span></td>
                            <td>
                                <div class="listing-actions-cell">
                                    <a href="?edit=<?= $t['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem;"><i class="fas fa-edit"></i></a>
                                    <a href="?delete=<?= $t['id'] ?>" class="admin-btn admin-btn-danger" style="padding:0.4rem; font-size:0.8rem;" onclick="return confirm('Delete tag?')"><i class="fas fa-trash"></i></a>
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
