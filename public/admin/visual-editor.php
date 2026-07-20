<?php
require_once 'auth.php';
auth_required();

$_SESSION['admin_editor_active'] = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visual Editor - Portfolio CMS</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            background: #111;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
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
            border-bottom: 1px solid #3f3f46;
            z-index: 100;
        }
        .nav-left { display: flex; align-items: center; gap: 1.5rem; }
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
                <div class="mode-badge">Visual Editor Mode</div>
                <a href="/admin/dashboard.php" class="admin-nav-link">Overview Dashboard</a>
            </div>
            
            <div class="nav-right">
                <a href="/admin/logout.php" class="admin-nav-link" style="color: #ef4444;">Exit Editor</a>
            </div>
        </nav>
        
        <div class="iframe-container">
            <iframe src="/"></iframe>
        </div>
    </div>
</body>
</html>
