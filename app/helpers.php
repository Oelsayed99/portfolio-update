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
    $editor_active = isset($_SESSION['admin_editor_active']);


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

/**
 * Send Contact Form Email
 */
function send_contact_email($name, $email, $message) {
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Load .env if it exists
        $envFile = dirname(__DIR__) . '/.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                if (strpos($line, '=') === false) continue;
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }

        // Server settings
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USER'] ?? 'om.he.els@gmail.com';
        $mail->Password   = $_ENV['SMTP_PASS'] ?? '';
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'] ?? 587;

        // Recipients
        $to = $_ENV['SMTP_USER'] ?? 'om.he.els@gmail.com';
        $mail->setFrom($_ENV['SMTP_FROM'] ?? 'om.he.els@gmail.com', 'Portfolio Contact');
        $mail->addAddress($to);
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Message: $name";
        
        $emailBody = "
        <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 10px;'>
            <h2 style='color: #2563eb;'>New Message from Portfolio</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p style='margin-top: 20px;'><strong>Message:</strong></p>
            <div style='background: #f9f9f9; padding: 15px; border-radius: 5px; border-left: 4px solid #2563eb;'>
                " . nl2br(htmlspecialchars($message)) . "
            </div>
        </div>
        ";

        $mail->Body = $emailBody;
        $mail->AltBody = "New Message from Portfolio\nName: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        return true;
    } catch (\Exception $e) {
        error_log("Contact email failed: {$mail->ErrorInfo}");
        return false;
    }
}
/**
 * Handle File Uploads
 */
function handle_upload($file, $target_dir = 'assets/uploads/') {
    // If no file was uploaded at all, return null (it's optional)
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception("The uploaded file exceeds the upload_max_filesize directive in php.ini.");
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.");
            case UPLOAD_ERR_PARTIAL:
                throw new Exception("The uploaded file was only partially uploaded.");
            case UPLOAD_ERR_NO_TMP_DIR:
                throw new Exception("Missing a temporary folder on the server.");
            case UPLOAD_ERR_CANT_WRITE:
                throw new Exception("Failed to write file to disk. Check disk space or permissions.");
            case UPLOAD_ERR_EXTENSION:
                throw new Exception("A PHP extension stopped the file upload.");
            default:
                throw new Exception("Unknown upload error (code: " . $file['error'] . ").");
        }
    }

    $target_dir = 'assets/uploads/';
    $upload_path = dirname(__DIR__) . '/public/' . $target_dir;
    
    // Check if the directory exists, try to create it
    if (!is_dir($upload_path)) {
        if (!mkdir($upload_path, 0777, true)) {
            throw new Exception("Failed to create upload directory: " . htmlspecialchars($upload_path) . ". Please check parent directory permissions.");
        }
    }

    // Check write permissions
    if (!is_writable($upload_path)) {
        throw new Exception("Upload directory is not writable: " . htmlspecialchars($upload_path) . ". Please check folder permissions on the server.");
    }

    // Security check: Validate file type
    $mime_type = null;
    if (function_exists('mime_content_type')) {
        $mime_type = mime_content_type($file['tmp_name']);
    } elseif (class_exists('finfo')) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->file($file['tmp_name']);
    }

    if ($mime_type !== null) {
        $allowed_types = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
            'video/mp4', 'video/quicktime', 'application/pdf'
        ];
        if (!in_array($mime_type, $allowed_types)) {
            throw new Exception("Invalid file type: " . htmlspecialchars($mime_type) . ". Allowed types: JPG, PNG, GIF, WEBP, SVG, MP4, MOV, and PDF.");
        }
    }

    $filename = time() . '_' . basename($file['name']);
    $target_file = $upload_path . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return '/' . $target_dir . $filename;
    }

    throw new Exception("Failed to move uploaded file. Check destination permissions.");
}
