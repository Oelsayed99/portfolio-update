<?php
require_once 'auth.php';
auth_required();

use app\models\Journey;

$msg = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    Journey::delete($id);
    $msg = 'Journey entry deleted successfully.';
}

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_journey'])) {
    $image_path = '';
    if (isset($_FILES['image_file'])) {
        $image_path = handle_upload($_FILES['image_file']);
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
        'image' => $image_path ?: ($_POST['image_url'] ?? '')
    ];

    try {
        Journey::create($data);
        $msg = 'Journey entry added successfully.';
    } catch (Exception $e) {
        $msg = 'Error adding journey entry: ' . $e->getMessage();
    }
}


$journey = Journey::all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journey Management</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-container">
        <header class="admin-header">
            <h1>Journey Management</h1>
            <a href="/admin/dashboard.php" class="admin-btn" target="_top">Back to Dashboard</a>

        </header>

        <?php if ($msg): ?>
            <p style="padding:1rem; background:#dcfce7; color:#166534; border-radius:8px;"><?= $msg ?></p>
        <?php endif; ?>

        <div class="admin-card">
            <h3>Add New Journey Entry</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="admin-form-group">
                        <label>Date (EN)</label>
                        <input type="text" name="date_en" class="admin-form-control" required placeholder="e.g. 2023">
                    </div>
                    <div class="admin-form-group">
                        <label>Date (AR)</label>
                        <input type="text" name="date_ar" class="admin-form-control" required dir="rtl">
                    </div>

                    <div class="admin-form-group">
                        <label>Title (EN)</label>
                        <input type="text" name="title_en" class="admin-form-control" required>
                    </div>
                    <div class="admin-form-group">
                        <label>Title (AR)</label>
                        <input type="text" name="title_ar" class="admin-form-control" required dir="rtl">
                    </div>

                    <div class="admin-form-group">
                        <label>Description (EN)</label>
                        <textarea name="description_en" class="admin-form-control"></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label>Description (AR)</label>
                        <textarea name="description_ar" class="admin-form-control" dir="rtl"></textarea>
                    </div>

                    <div class="admin-form-group">
                        <label>Tag Text (EN)</label>
                        <input type="text" name="tag_en" class="admin-form-control" placeholder="e.g. PROJECT">
                    </div>
                    <div class="admin-form-group">
                        <label>Tag Text (AR)</label>
                        <input type="text" name="tag_ar" class="admin-form-control" dir="rtl" placeholder="مشروع">
                    </div>

                    <div class="admin-form-group">
                        <label>Tag Type (Style/Icon)</label>
                        <select name="tag_type" class="admin-form-control">
                            <option value="project">Project (Code Icon)</option>
                            <option value="career">Career (Briefcase Icon)</option>
                            <option value="cert">Certification (Certificate Icon)</option>
                            <option value="learning">Learning (Graduation Icon)</option>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Timeline Side</label>
                        <select name="side" class="admin-form-control">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>

                    <div class="admin-form-group">
                        <label>Upload Image (Optional)</label>
                        <input type="file" name="image_file" class="admin-form-control" accept="image/*">
                    </div>
                    <div class="admin-form-group">
                        <label>OR Image URL</label>
                        <input type="text" name="image_url" class="admin-form-control" placeholder="/assets/images/...">
                    </div>
                </div>
                <button type="submit" name="add_journey" class="admin-btn admin-btn-primary" style="margin-top:1rem">Add Journey Entry</button>
            </form>
        </div>


        <div class="admin-card">
            <h3>Existing Journey Entries</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title (EN)</th>
                        <th>Side</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($journey as $j): ?>
                    <tr>
                        <td><?= htmlspecialchars($j['date_en']) ?></td>
                        <td><?= htmlspecialchars($j['title_en']) ?></td>
                        <td><?= strtoupper($j['side']) ?></td>
                        <td>
                            <a href="journey-edit.php?id=<?= $j['id'] ?>" class="admin-btn" style="background:#3b82f6; color:white; margin-right:5px;">Edit</a>
                            <a href="?delete=<?= $j['id'] ?>" class="admin-btn admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
