<?php
session_start();

// Autoloader for Admin Area
spl_autoload_register(function ($class) {
    $baseDir = dirname(__DIR__, 2);
    $path = $baseDir . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

require_once dirname(__DIR__, 2) . '/app/database.php';
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';


// Auth Check Function
if (!function_exists('auth_required')) {
    function auth_required() {
        if (!isset($_SESSION['admin_user_id'])) {
            header('Location: /admin/login.php');
            exit;
        }
    }
}

// CSRF Protection (Simplified)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['csrf_token']) && !isset($_SERVER['HTTP_X_CSRF_TOKEN'])) {
    // In a real app, verify CSRF token
}
