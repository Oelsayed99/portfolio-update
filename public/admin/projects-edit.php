<?php
require_once 'auth.php';
auth_required();

use app\models\Project;

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: projects-manage.php');
    exit;
}

$project = Project::find($id);
if (!$project) {
    die("Project not found.");
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_project'])) {
    $image_path = $project['image'];
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $image_path = handle_upload($_FILES['image_file']);
    } elseif (!empty($_POST['image_url'])) {
        $image_path = $_POST['image_url'];
    }

    $data = [
        'type' => $_POST['type'] ?? $project['type'],
        'title_en' => $_POST['title_en'] ?? '',
        'title_ar' => $_POST['title_ar'] ?? '',
        'tech_en' => $_POST['tech_en'] ?? '',
        'tech_ar' => $_POST['tech_ar'] ?? '',
        'description_en' => $_POST['description_en'] ?? '',
        'description_ar' => $_POST['description_ar'] ?? '',
        'image' => $image_path,
        'link' => $_POST['link'] ?? '',
        'icons' => $_POST['icons'] ?? ''
    ];

    try {
        Project::update($id, $data);
        $msg = 'Project updated successfully.';
        $project = Project::find($id); // Refresh data
    } catch (Exception $e) {
        $msg = 'Error updating project: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .full-width { grid-column: span 2; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-container">
        <header class="admin-header">
            <h1>Edit Project</h1>
            <a href="/admin/projects-manage.php" class="admin-btn">Back to List</a>
        </header>

        <?php if ($msg): ?>
            <p style="padding:1rem; background:#dcfce7; color:#166534; border-radius:8px;"><?= $msg ?></p>
        <?php endif; ?>

        <div class="admin-card">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="admin-form-group">
                        <label>Section / Type</label>
                        <select name="type" class="admin-form-control" required>
                            <option value="pro" <?= $project['type'] === 'pro' ? 'selected' : '' ?>>Professional System (Icon Based)</option>
                            <option value="live" <?= $project['type'] === 'live' ? 'selected' : '' ?>>Live Project (Image Based)</option>
                        </select>
                    </div>
                    <div></div> <!-- Spacer -->
                    
                    <div class="admin-form-group">
                        <label>Title (EN)</label>
                        <input type="text" name="title_en" class="admin-form-control" required value="<?= htmlspecialchars($project['title_en']) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Title (AR)</label>
                        <input type="text" name="title_ar" class="admin-form-control" dir="rtl" required value="<?= htmlspecialchars($project['title_ar']) ?>">
                    </div>
                    
                    <div class="admin-form-group">
                        <label>Tech Stack / Icons (EN)</label>
                        <input type="text" name="tech_en" class="admin-form-control" placeholder="e.g. Linux, Docker" value="<?= htmlspecialchars($project['tech_en']) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Tech Stack (AR)</label>
                        <input type="text" name="tech_ar" class="admin-form-control" dir="rtl" value="<?= htmlspecialchars($project['tech_ar']) ?>">
                    </div>

                    <div class="admin-form-group full-width">
                        <label>Icons (Comma separated, e.g. free-code-camp, linux, server)</label>
                        <input type="text" name="icons" class="admin-form-control" value="<?= htmlspecialchars($project['icons']) ?>">
                    </div>

                    <div class="admin-form-group">
                        <label>Description (EN)</label>
                        <textarea name="description_en" class="admin-form-control"><?= htmlspecialchars($project['description_en']) ?></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label>Description (AR)</label>
                        <textarea name="description_ar" class="admin-form-control" dir="rtl"><?= htmlspecialchars($project['description_ar']) ?></textarea>
                    </div>

                    <div class="admin-form-group">
                        <label>Change Image (Mainly for Live)</label>
                        <input type="file" name="image_file" class="admin-form-control" accept="image/*">
                        <small>Current: <?= $project['image'] ?></small>
                    </div>
                    <div class="admin-form-group">
                        <label>OR Image URL</label>
                        <input type="text" name="image_url" class="admin-form-control" value="<?= htmlspecialchars($project['image']) ?>">
                    </div>

                    <div class="admin-form-group full-width">
                        <label>Live Link (Mainly for Live)</label>
                        <input type="text" name="link" class="admin-form-control" value="<?= htmlspecialchars($project['link']) ?>">
                    </div>
                </div>
                <button type="submit" name="update_project" class="admin-btn admin-btn-primary" style="margin-top:1rem">Update Project</button>
            </form>
        </div>
    </div>
</body>
</html>
