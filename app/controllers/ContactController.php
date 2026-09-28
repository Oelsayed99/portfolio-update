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
            $topic = trim($_POST['topic'] ?? '');

            if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
                if ($topic !== '') {
                    $message = 'Topic: ' . mb_substr($topic, 0, 60) . "\n\n" . $message;
                }
                $sent = send_contact_email($name, $email, $message);
                header('Location: /contact?' . ($sent ? 'success=1' : 'error=1'));
            } else {
                header('Location: /contact?error=1');
            }
            exit;
        }
    }

}
