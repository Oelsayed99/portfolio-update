<?php
require_once 'auth.php';
auth_required();

use app\models\Journey;

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: journey-manage.php');
    exit;
}

$entry = Journey::find($id);
if (!$entry) {
    die("Entry not found.");
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_journey'])) {
    $image_path = $entry['image'];
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $image_path = handle_upload($_FILES['image_file']);
    } elseif (!empty($_POST['image_url'])) {
        $image_path = $_POST['image_url'];
    }

    $data = [
        'date_en' => $_POST['date_en'] ?? '',
        'date_ar' => $_POST['date_ar'] ?? '',
        'title_en' => $_POST['title_en'] ?? '',
        'title_ar' => $_POST['title_ar'] ?? '',
        'description_en' => $_POST['description_en'] ?? '',
        'description_ar' => $_POST['description_ar'] ?? '',
        'tag_en' => $_POST['tag_en'] ?? '',
        'tag_ar' => $_POST['tag_ar'] ?? '',
        'tag_type' => $_POST['tag_type'] ?? 'project',
        'side' => $_POST['side'] ?? 'left',
        'image' => $image_path
    ];

    try {
        Journey::update($id, $data);
        $msg = 'Journey entry updated successfully.';
        $entry = Journey::find($id); // Refresh data
    } catch (Exception $e) {
        $msg = 'Error updating entry: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Journey Entry</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-container">
        <header class="admin-header">
            <h1>Edit Journey Entry</h1>
            <a href="/admin/journey-manage.php" class="admin-btn">Back to List</a>
        </header>

        <?php if ($msg): ?>
            <p style="padding:1rem; background:#dcfce7; color:#166534; border-radius:8px;"><?= $msg ?></p>
        <?php endif; ?>

        <div class="admin-card">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="admin-form-group">
                        <label>Date (EN)</label>
                        <input type="text" name="date_en" class="admin-form-control" required value="<?= htmlspecialchars($entry['date_en']) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Date (AR)</label>
                        <input type="text" name="date_ar" class="admin-form-control" required dir="rtl" value="<?= htmlspecialchars($entry['date_ar']) ?>">
                    </div>

                    <div class="admin-form-group">
                        <label>Title (EN)</label>
                        <input type="text" name="title_en" class="admin-form-control" required value="<?= htmlspecialchars($entry['title_en']) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Title (AR)</label>
                        <input type="text" name="title_ar" class="admin-form-control" required dir="rtl" value="<?= htmlspecialchars($entry['title_ar']) ?>">
                    </div>

                    <div class="admin-form-group">
                        <label>Description (EN)</label>
                        <textarea name="description_en" class="admin-form-control"><?= htmlspecialchars($entry['description_en']) ?></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label>Description (AR)</label>
                        <textarea name="description_ar" class="admin-form-control" dir="rtl"><?= htmlspecialchars($entry['description_ar']) ?></textarea>
                    </div>

                    <div class="admin-form-group">
                        <label>Tag Text (EN)</label>
                        <input type="text" name="tag_en" class="admin-form-control" value="<?= htmlspecialchars($entry['tag_en']) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Tag Text (AR)</label>
                        <input type="text" name="tag_ar" class="admin-form-control" dir="rtl" value="<?= htmlspecialchars($entry['tag_ar']) ?>">
                    </div>

                    <div class="admin-form-group">
                        <label>Tag Type</label>
                        <select name="tag_type" class="admin-form-control">
                            <option value="project" <?= $entry['tag_type'] === 'project' ? 'selected' : '' ?>>Project</option>
                            <option value="career" <?= $entry['tag_type'] === 'career' ? 'selected' : '' ?>>Career</option>
                            <option value="cert" <?= $entry['tag_type'] === 'cert' ? 'selected' : '' ?>>Certification</option>
                            <option value="learning" <?= $entry['tag_type'] === 'learning' ? 'selected' : '' ?>>Learning</option>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Timeline Side</label>
                        <select name="side" class="admin-form-control">
                            <option value="left" <?= $entry['side'] === 'left' ? 'selected' : '' ?>>Left</option>
                            <option value="right" <?= $entry['side'] === 'right' ? 'selected' : '' ?>>Right</option>
                        </select>
                    </div>

                    <div class="admin-form-group">
                        <label>Change Image</label>
                        <input type="file" name="image_file" class="admin-form-control" accept="image/*">
                    </div>
                    <div class="admin-form-group">
                        <label>OR Image URL</label>
                        <input type="text" name="image_url" class="admin-form-control" value="<?= htmlspecialchars($entry['image']) ?>">
                    </div>
                </div>
                <button type="submit" name="update_journey" class="admin-btn admin-btn-primary" style="margin-top:1rem">Update Entry</button>
            </form>
        </div>
    </div>
</body>
</html>
