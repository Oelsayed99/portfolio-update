<?php
require_once 'auth.php';
auth_required();

use app\models\Project;

$msg = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    Project::delete($id);
    $msg = 'Project deleted successfully.';
}

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_project'])) {
    $image_path = '';
    if (isset($_FILES['image_file'])) {
        $image_path = handle_upload($_FILES['image_file']);
    }

    $data = [
        'type' => $_POST['type'] ?? 'live',
        'title_en' => $_POST['title_en'] ?? '',
        'title_ar' => $_POST['title_ar'] ?? '',
        'tech_en' => $_POST['tech_en'] ?? '',
        'tech_ar' => $_POST['tech_ar'] ?? '',
        'description_en' => $_POST['description_en'] ?? '',
        'description_ar' => $_POST['description_ar'] ?? '',
        'image' => $image_path ?: ($_POST['image_url'] ?? ''),
        'link' => $_POST['link'] ?? '',
        'icons' => $_POST['icons'] ?? ''
    ];

    try {
        Project::create($data);
        $msg = 'Project added successfully.';
    } catch (Exception $e) {
        $msg = 'Error adding project: ' . $e->getMessage();
    }
}


$projects = Project::all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Management</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .full-width { grid-column: span 2; }
    </style>
</head>
<body class="admin-body">
    <div class="admin-container">
        <header class="admin-header">
            <h1>Project Management</h1>
            <a href="/admin/dashboard.php" class="admin-btn">Back to Dashboard</a>
        </header>

        <?php if ($msg): ?>
            <p style="padding:1rem; background:#dcfce7; color:#166534; border-radius:8px;"><?= $msg ?></p>
        <?php endif; ?>

        <div class="admin-card">
            <h3>Add New Project</h3>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="admin-form-group">
                        <label>Section / Type</label>
                        <select name="type" class="admin-form-control" required>
                            <option value="pro">Professional System (Icon Based)</option>
                            <option value="live">Live Project (Image Based)</option>
                        </select>
                    </div>
                    <div></div> <!-- Spacer -->
                    
                    <div class="admin-form-group">
                        <label>Title (EN)</label>
                        <input type="text" name="title_en" class="admin-form-control" required>
                    </div>
                    <div class="admin-form-group">
                        <label>Title (AR)</label>
                        <input type="text" name="title_ar" class="admin-form-control" dir="rtl" required>
                    </div>
                    
                    <div class="admin-form-group">
                        <label>Tech Stack / Icons (EN)</label>
                        <input type="text" name="tech_en" class="admin-form-control" placeholder="e.g. Linux, Docker (for Pro)">
                    </div>
                    <div class="admin-form-group">
                        <label>Tech Stack (AR)</label>
                        <input type="text" name="tech_ar" class="admin-form-control" dir="rtl">
                    </div>

                    <div class="admin-form-group full-width">
                        <label>Icons (Comma separated, e.g. free-code-camp, linux, server)</label>
                        <input type="text" name="icons" class="admin-form-control" placeholder="free-code-camp, linux, server, code">
                    </div>


                    <div class="admin-form-group">
                        <label>Description (EN) - Mainly for Live</label>
                        <textarea name="description_en" class="admin-form-control"></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label>Description (AR) - Mainly for Live</label>
                        <textarea name="description_ar" class="admin-form-control" dir="rtl"></textarea>
                    </div>

                    <div class="admin-form-group">
                        <label>Upload Image (Mainly for Live)</label>
                        <input type="file" name="image_file" class="admin-form-control" accept="image/*">
                    </div>
                    <div class="admin-form-group">
                        <label>OR Image URL</label>
                        <input type="text" name="image_url" class="admin-form-control" placeholder="/assets/images/...">
                    </div>

                    <div class="admin-form-group full-width">
                        <label>Live Link (Mainly for Live)</label>
                        <input type="text" name="link" class="admin-form-control" placeholder="https://...">
                    </div>
                </div>
                <button type="submit" name="add_project" class="admin-btn admin-btn-primary" style="margin-top:1rem">Add Project</button>
            </form>
        </div>


        <div class="admin-card">
            <h3>Existing Projects</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Title (EN)</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $p): ?>
                    <tr>
                        <td><span class="mode-badge" style="background:<?= $p['type'] === 'pro' ? '#3b82f6' : '#10b981' ?>"><?= strtoupper($p['type']) ?></span></td>
                        <td><?= htmlspecialchars($p['title_en']) ?></td>
                        <td><?= $p['created_at'] ?></td>
                        <td>
                            <a href="?delete=<?= $p['id'] ?>" class="admin-btn admin-btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
