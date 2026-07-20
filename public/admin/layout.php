<?php
require_once 'auth.php';
auth_required();

// Helper to handle simple file uploads
if (!function_exists('handle_upload')) {
    function handle_upload($file, $folder = 'uploads') {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return '';
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'pdf', 'mp4', 'mov'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            throw new Exception("Invalid file type. Allowed: " . implode(', ', $allowed));
        }

        $baseDir = dirname(dirname(__DIR__)) . '/public/assets/' . $folder;
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0755, true);
        }

        $filename = uniqid('asset_', true) . '.' . $ext;
        $dest = $baseDir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $dest)) {
            // Save in media table
            $filepath = '/assets/' . $folder . '/' . $filename;
            app\models\Media::create([
                'filename' => $file['name'],
                'filepath' => $filepath,
                'file_type' => $file['type'],
                'file_size' => $file['size'],
                'folder' => $folder
            ]);
            return $filepath;
        }

        return '';
    }
}

function admin_header($title = "Dashboard", $activeLink = "dashboard") {
    $lang = $_SESSION['lang'] ?? 'en';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($title) ?> - Portfolio CMS</title>
        <link rel="stylesheet" href="/assets/css/admin.css">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body class="admin-body">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <i class="fas fa-cubes"></i> CMS Panel
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="/admin/dashboard.php" class="sidebar-link <?= $activeLink === 'dashboard' ? 'active' : '' ?>">
                        <i class="fas fa-chart-pie"></i> Overview
                    </a>
                </li>
                <li>
                    <a href="/admin/visual-editor.php" class="sidebar-link <?= $activeLink === 'visual' ? 'active' : '' ?>">
                        <i class="fas fa-edit"></i> Visual Editor
                    </a>
                </li>
                <li>
                    <a href="/admin/projects-manage.php" class="sidebar-link <?= $activeLink === 'projects' ? 'active' : '' ?>">
                        <i class="fas fa-briefcase"></i> Projects
                    </a>
                </li>
                <li>
                    <a href="/admin/sections-manage.php" class="sidebar-link <?= $activeLink === 'sections' ? 'active' : '' ?>">
                        <i class="fas fa-list"></i> Sections
                    </a>
                </li>
                <li>
                    <a href="/admin/technologies.php" class="sidebar-link <?= $activeLink === 'technologies' ? 'active' : '' ?>">
                        <i class="fas fa-code"></i> Technologies
                    </a>
                </li>
                <li>
                    <a href="/admin/tags.php" class="sidebar-link <?= $activeLink === 'tags' ? 'active' : '' ?>">
                        <i class="fas fa-tags"></i> Tags
                    </a>
                </li>

                <li>
                    <a href="/admin/journey-manage.php" class="sidebar-link <?= $activeLink === 'journey' ? 'active' : '' ?>">
                        <i class="fas fa-history"></i> Journey
                    </a>
                </li>
                <li>
                    <a href="/admin/users.php" class="sidebar-link <?= $activeLink === 'users' ? 'active' : '' ?>">
                        <i class="fas fa-user-gear"></i> Users
                    </a>
                </li>
                <li style="margin-top: auto;">
                    <a href="/admin/logout.php" class="sidebar-link" style="color: var(--admin-danger);">
                        <i class="fas fa-right-from-bracket"></i> Logout
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-workspace">
            <header class="admin-header">
                <h1><?= htmlspecialchars($title) ?></h1>
                <div style="display:flex; gap:1rem; align-items:center;">
                    <a href="/" target="_blank" class="admin-btn admin-btn-secondary"><i class="fas fa-eye"></i> View Site</a>
                </div>
            </header>
    <?php
}

function admin_footer() {
    ?>
        </main>
    </body>
    </html>
    <?php
}
