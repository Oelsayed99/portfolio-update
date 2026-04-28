<?php

namespace app\controllers;

class ContactController extends Controller
{
    public function index()
    {
        $this->render('contact', [
            'title_key' => 'nav_contact',
            'active_page' => 'contact'
        ]);
    }

    public function submit()
    {
        // Simple form handling
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // In a real app, you'd process the form here
            // For now, just simulate success
            header('Location: /contact?success=1');
            exit;
        }
    }
}
