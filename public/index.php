<?php

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
$router->add('blog', 'app\controllers\BlogController', 'index');
$router->add('contact', 'app\controllers\ContactController', 'index');
$router->add('contact/submit', 'app\controllers\ContactController', 'submit');
$router->add('lang', 'app\controllers\Controller', 'switchLang');

// Dispatch
$url = $_GET['url'] ?? '';
$router->dispatch($url);
