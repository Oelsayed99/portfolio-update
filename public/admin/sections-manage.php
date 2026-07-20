<?php
require_once 'layout.php';

use app\models\ProjectSection;

$msg = '';
$err = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    ProjectSection::delete($id);
    $msg = 'Section deleted successfully.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_section'])) {
    try {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        
        $name_en = $_POST['name_en'] ?? '';
        $slug = !empty($_POST['slug']) ? $_POST['slug'] : strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name_en)));

        $data = [
            'name_en' => $name_en,
            'name_ar' => $_POST['name_ar'] ?? '',
            'slug' => $slug,
            'description_en' => $_POST['description_en'] ?? '',
            'description_ar' => $_POST['description_ar'] ?? '',
            'display_order' => (int)($_POST['display_order'] ?? 0),
            'active' => isset($_POST['active']) ? 1 : 0
        ];

        if ($id) {
            ProjectSection::update($id, $data);
            $msg = 'Section updated successfully.';
        } else {
            ProjectSection::create($data);
            $msg = 'Section created successfully.';
        }
    } catch (Exception $e) {
        $err = $e->getMessage();
    }
}

$editSection = null;
if (isset($_GET['edit'])) {
    $editSection = ProjectSection::find((int)$_GET['edit']);
}

$sections = ProjectSection::all();
admin_header("Section Manager", "sections");
?>

<?php if ($msg): ?>
    <div style="padding:1rem; background:rgba(34,197,94,0.15); color:var(--admin-success); border:1px solid var(--admin-success); border-radius:8px; margin-bottom:1.5rem;"><?= $msg ?></div>
<?php endif; ?>

<div class="admin-two-col-layout">
    <!-- Form -->
    <div class="admin-card">
        <h3><?= $editSection ? 'Edit Section' : 'Add New Section' ?></h3>
        <form method="POST">
            <?php if ($editSection): ?>
                <input type="hidden" name="id" value="<?= $editSection['id'] ?>">
            <?php endif; ?>
            
            <div class="admin-form-group">
                <label>Section Name (English)</label>
                <input type="text" name="name_en" class="admin-form-control" value="<?= htmlspecialchars($editSection['name_en'] ?? '') ?>" required>
            </div>
            
            <div class="admin-form-group">
                <label>Section Name (Arabic)</label>
                <input type="text" name="name_ar" class="admin-form-control" value="<?= htmlspecialchars($editSection['name_ar'] ?? '') ?>" required>
            </div>

            <div class="admin-form-group">
                <label>Slug (Optional)</label>
                <input type="text" name="slug" class="admin-form-control" value="<?= htmlspecialchars($editSection['slug'] ?? '') ?>">
            </div>

            <div class="admin-form-group">
                <label>Description (English)</label>
                <textarea name="description_en" class="admin-form-control" rows="3"><?= htmlspecialchars($editSection['description_en'] ?? '') ?></textarea>
            </div>

            <div class="admin-form-group">
                <label>Description (Arabic)</label>
                <textarea name="description_ar" class="admin-form-control" rows="3" dir="rtl"><?= htmlspecialchars($editSection['description_ar'] ?? '') ?></textarea>
            </div>

            <div class="admin-form-group">
                <label>Display Order</label>
                <input type="number" name="display_order" class="admin-form-control" value="<?= htmlspecialchars($editSection['display_order'] ?? 0) ?>">
            </div>

            <div class="admin-form-group" style="flex-direction:row; align-items:center; gap:0.5rem;">
                <input type="checkbox" name="active" value="1" id="chk-active" <?= ($editSection['active'] ?? 1) ? 'checked' : '' ?>>
                <label for="chk-active" style="margin:0; cursor:pointer;">Active</label>
            </div>

            <div style="margin-top:1.5rem; display:flex; gap:0.5rem;">
                <?php if ($editSection): ?>
                    <a href="/admin/sections-manage.php" class="admin-btn admin-btn-secondary" style="flex-grow:1; text-align:center;">Cancel</a>
                <?php endif; ?>
                <button type="submit" name="save_section" class="admin-btn admin-btn-primary" style="flex-grow:2;">Save</button>
            </div>
        </form>
    </div>

    <!-- Listing -->
    <div class="admin-card">
        <h3>Registered Sections</h3>
        <div class="admin-table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Name (EN)</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sections as $s): ?>
                        <tr>
                            <td><strong>#<?= $s['display_order'] ?></strong></td>
                            <td><strong><?= htmlspecialchars($s['name_en']) ?></strong></td>
                            <td><span style="font-family:monospace;"><?= htmlspecialchars($s['slug']) ?></span></td>
                            <td>
                                <span class="admin-badge <?= $s['active'] ? 'admin-badge-success' : 'admin-badge-danger' ?>">
                                    <?= $s['active'] ? 'Active' : 'Inactive' ?>
                                </span>
                            </td>
                            <td>
                                <div class="listing-actions-cell">
                                    <a href="?edit=<?= $s['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem;"><i class="fas fa-edit"></i></a>
                                    <a href="?delete=<?= $s['id'] ?>" class="admin-btn admin-btn-danger" style="padding:0.4rem; font-size:0.8rem;" onclick="return confirm('Delete section?')" <?= in_array($s['slug'], ['featured', 'professional', 'personal']) ? 'style="display:none;"' : '' ?>><i class="fas fa-trash"></i></a>
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
