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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            if ($name && $email && $message) {
                send_contact_email($name, $email, $message);
                header('Location: /contact?success=1');
            } else {
                header('Location: /contact?error=1');
            }
            exit;
        }
    }

}
