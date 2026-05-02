<?php
require_once 'auth.php';
auth_required();

use app\models\User;
use app\models\Translation;

// Get some stats
$userCount = User::count();
$transCount = Translation::count();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Site Editor</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background: #111;
        }
        .admin-wrapper {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .admin-navbar {
            background: #18181b;
            color: white;
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #333;
            z-index: 100;
        }
        .nav-left { display: flex; align-items: center; gap: 2rem; }
        .nav-right { display: flex; align-items: center; gap: 1rem; }
        
        .admin-nav-link {
            color: #a1a1aa;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .admin-nav-link:hover, .admin-nav-link.active { color: white; }
        
        .iframe-container {
            flex: 1;
            position: relative;
            background: #fff;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .mode-badge {
            background: #a855f7;
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <nav class="admin-navbar">
            <div class="nav-left">
                <div style="font-weight: 800; font-size: 1.1rem; letter-spacing: -0.5px;">
                    PORTFOLIO <span style="color: #a855f7;">CMS</span>
                </div>
                <div class="mode-badge">Editor Mode</div>
                <a href="/admin/dashboard.php" class="admin-nav-link active">Editor</a>
                <a href="/admin/projects-manage.php" class="admin-nav-link">Projects</a>
                <a href="/admin/journey-manage.php" class="admin-nav-link">Journey</a>
                <a href="/admin/users.php" class="admin-nav-link">Users</a>

            </div>
            
            <div class="nav-right">
                <span style="font-size: 0.85rem; color: #a1a1aa;">Logged in as <strong><?= $_SESSION['admin_username'] ?></strong></span>
                <a href="/admin/logout.php" class="admin-btn" style="background: transparent; border: 1px solid #3f3f46; color: white; font-size: 0.8rem;">Logout</a>
            </div>
        </nav>
        
        <div class="iframe-container">
            <!-- We pass a query param to tell the app to enable the editor -->
            <iframe src="/?admin_editor=1" id="site-iframe"></iframe>
        </div>
    </div>

    <script>
        // Optional: Handle link clicks inside iframe to keep them in the iframe with the editor param
        const iframe = document.getElementById('site-iframe');
        iframe.onload = function() {
            try {
                const iframeWin = iframe.contentWindow;
                const iframeDoc = iframe.contentDocument || iframeWin.document;
                
                // Monitor clicks on links inside the iframe
                iframeDoc.addEventListener('click', function(e) {
                    const link = e.target.closest('a');
                    if (link && link.href && link.href.startsWith(window.location.origin)) {
                        e.preventDefault();
                        const url = new URL(link.href);
                        url.searchParams.set('admin_editor', '1');
                        iframe.src = url.toString();
                    }
                }, true);
            } catch (err) {
                console.warn("Cross-origin or other error in iframe monitoring:", err);
            }
        };
    </script>
</body>
</html>
