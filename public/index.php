<?php
// If running under built-in web server and the file exists, serve it directly
if (php_sapi_name() === 'cli-server') {
    $path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if ($path !== '/') {
        $filePath = __DIR__ . $path;
        if (is_dir($filePath)) {
            $filePath = rtrim($filePath, '/') . '/index.php';
        }
        if (is_file($filePath)) {
            return false;
        }
    }
}

header('Content-Type: text/html; charset=UTF-8');

/**
 * Portfolio Website - Entry Point
 * 
 * This is the front controller that handles all incoming requests.
 */

// Basic error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define constants
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/views');
define('PARTIAL_PATH', BASE_PATH . '/partials');

// Start session
session_start();

// Include core files
require_once APP_PATH . '/database.php';
require_once APP_PATH . '/helpers.php';
if (file_exists(BASE_PATH . '/vendor/autoload.php')) {
    require_once BASE_PATH . '/vendor/autoload.php';
}


// Simple Autoloader
spl_autoload_register(function ($class) {
    $path = BASE_PATH . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

// Start the router
require_once APP_PATH . '/Router.php';

$router = new app\Router();

// Define Routes
$router->add('', 'app\controllers\HomeController', 'index');
$router->add('about', 'app\controllers\AboutController', 'index');
$router->add('projects', 'app\controllers\ProjectController', 'index');
$router->add('projects/:slug', 'app\controllers\ProjectController', 'detail');
$router->add('blog', 'app\controllers\BlogController', 'index');
$router->add('contact', 'app\controllers\ContactController', 'index');
$router->add('contact/submit', 'app\controllers\ContactController', 'submit');
$router->add('lang', 'app\controllers\Controller', 'switchLang');

// Dispatch
$url = $_GET['url'] ?? '';
if (empty($url)) {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = trim($requestUri, '/');
}
$router->dispatch($url);
