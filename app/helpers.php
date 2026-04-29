<?php

/**
 * Translation Helper
 */

use app\models\Translation;

function translate($msgid) {
    $lang = $_SESSION['lang'] ?? $_COOKIE['lang'] ?? 'en';
    return Translation::get($msgid, $lang);
}

/**
 * Editable Translation Wrapper (for Admin)
 */
function t($msgid) {
    $text = translate($msgid);
    
    // Check if we should show the editor
    $is_admin = isset($_SESSION['admin_user_id']);
    $editor_active = isset($_GET['admin_editor']);

    if ($is_admin && $editor_active) {
        $lang = $_SESSION['lang'] ?? $_COOKIE['lang'] ?? 'en';
        $data = Translation::getWithEn($msgid, $lang);
        $en_text = $data['en'] ?? $msgid;

        return "<span class='editable-translation' data-msgid='" . htmlspecialchars($msgid) . "' data-en='" . htmlspecialchars($en_text) . "' data-lang='" . htmlspecialchars($lang) . "'>" . $text . "</span>";
    }
    
    return $text;
}

/**
 * Language Switcher Helper
 */
function get_current_lang() {
    return $_SESSION['lang'] ?? $_COOKIE['lang'] ?? 'en';
}

function is_rtl() {
    return get_current_lang() === 'ar';
}

/**
 * Send Password Reset Email using PHPMailer
 */
function send_reset_email($email, $reset_link) {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Load .env if it exists
        $envFile = dirname(__DIR__) . '/.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                list($name, $value) = explode('=', $line, 2);
                $_ENV[trim($name)] = trim($value);
            }
        }

        // Server settings
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'] ?? 'om.he.els@gmail.com';
        $mail->Password   = $_ENV['SMTP_PASS'] ?? ''; // App Password
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'] ?? 587;

        // Recipients
        $mail->setFrom($_ENV['SMTP_FROM'] ?? 'om.he.els@gmail.com', $_ENV['SMTP_FROM_NAME'] ?? 'Omar Elsayed Portfolio');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request - Omar Elsayed Portfolio';
        
        $message = "
        <html>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <div style='max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>
                <h2 style='color: #2563eb;'>Password Reset Request</h2>
                <p>Hello,</p>
                <p>You are receiving this email because we received a password reset request for your account.</p>
                <p style='margin: 30px 0;'>
                    <a href='{$reset_link}' style='background-color: #2563eb; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Reset Password</a>
                </p>
                <p>If you did not request a password reset, no further action is required.</p>
                <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
                <p style='font-size: 0.8rem; color: #666;'>
                    If you're having trouble clicking the \"Reset Password\" button, copy and paste the URL below into your web browser:<br>
                    <span style='word-break: break-all;'>{$reset_link}</span>
                </p>
            </div>
        </body>
        </html>
        ";

        $mail->Body = $message;
        $mail->AltBody = "Hello,\n\nYou are receiving this email because we received a password reset request for your account.\n\nReset Link: {$reset_link}\n\nIf you did not request a password reset, no further action is required.";

        $mail->send();
        return true;
    } catch (\Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}


