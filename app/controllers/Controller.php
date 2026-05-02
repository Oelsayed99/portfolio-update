<?php

namespace app\controllers;

class Controller
{
    public function switchLang()
    {
        $lang = $_GET['lang'] ?? 'en';
        if (in_array($lang, ['en', 'ar'])) {
            $_SESSION['lang'] = $lang;
            setcookie('lang', $lang, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'samesite' => 'Lax'
            ]);

        }
        
        $referrer = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $referrer");
        exit;
    }

    /**
     * Render a view file
     */
    protected function render($view, $data = [])
    {
        // Extract data to make it available in the view
        extract($data);

        $viewFile = VIEW_PATH . '/' . $view . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View file '$view' not found at $viewFile");
        }
    }
}
