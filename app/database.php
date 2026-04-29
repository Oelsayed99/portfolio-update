<?php

use app\models\Translation;
use app\models\User;

/**
 * Database Initialization for MySQL
 */

$host = getenv('DB_HOST') ?: 'db';
$name = getenv('DB_NAME') ?: 'portfolio';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'root';

try {
    // Initial connection to ensure DB exists and create tables
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$name` "); // Just to be sure, although DSN usually handles it

    // Create translations table
    $pdo->exec("CREATE TABLE IF NOT EXISTS translations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        msgid VARCHAR(255) UNIQUE NOT NULL,
        en TEXT,
        ar TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // Create users table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) UNIQUE NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        reset_token VARCHAR(255),
        token_expiry DATETIME,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // Re-connect with DB name in DSN for the models
    $db = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Seed Translations
    $count = $db->query("SELECT COUNT(*) FROM translations")->fetchColumn();
    if ($count == 0) {
        $translations = [
            ['nav_home', 'Home', 'الرئيسية'],
            ['nav_about', 'About', 'من أنا'],
            ['nav_projects', 'Projects', 'المشاريع'],
            ['nav_blog', 'Journey & Updates', 'رحلتي وتحديثاتي'],
            ['nav_contact', 'Contact', 'اتصل بي'],
            ['nav_work', 'Work', 'الأعمال'],
            ['nav_services', 'Services', 'الخدمات'],
            ['nav_get_in_touch', 'Get in Touch', 'تواصل معي'],
            ['hero_hello', "Hello, I'm", 'مرحباً، أنا'],
            ['hero_name', 'Omar Elsayed', 'عمر السيد'],
            ['hero_title', 'Software Engineer & Full-Stack Developer', 'مهندس برمجيات ومطور شامل'],
            ['hero_desc', 'Creating innovative and scalable web applications with a focus on user experience and performance.', 'إنشاء تطبيقات ويب مبتكرة وقابلة للتطوير مع التركيز على تجربة المستخدم والأداء.'],
            ['btn_hire', 'Hire Me', 'وظفني'],
            ['btn_projects', 'View Projects', 'عرض المشاريع'],
            ['about_heading', 'About Omar.', 'عن عمر.'],
            ['about_subtitle', 'Crafting High-Performance Backend Systems', 'تطوير أنظمة خلفية عالية الأداء'],
            ['about_pro_story_title', 'Professional Story', 'القصة المهنية'],
            ['about_pro_story', "My journey in software engineering began with a fascination for complex problem-solving and building scalable architectures. Over the years, I've honed my expertise in developing robust, enterprise-grade applications that drive business growth.", 'بدأت رحلتي في هندسة البرمجيات بشغف بحل المشكلات المعقدة وبناء هياكل قابلة للتطوير.'],
            ['about_arch_title', 'Backend Architecture & Performance', 'هندسة الخلفية والأداء'],
            ['about_arch_desc', 'I specialize in designing and implementing high-throughput backend systems.', 'أتخصص في تصميم وتنفيذ أنظمة خلفية عالية الإنتاجية.'],
            ['about_skills_title', 'Skills & Expertise', 'المهارات والخبرات'],
            ['skill_backend', 'Backend', 'الخلفية'],
            ['skill_frontend', 'Frontend', 'الواجهة'],
            ['skill_database', 'Database', 'قواعد البيانات'],
            ['projects_heading', 'Portfolio Projects', 'مشاريع المحفظة'],
            ['projects_subtitle', 'Exploring a range of professional and live software engineering work.', 'استكشاف مجموعة من الأعمال الهندسية البرمجية المهنية والحية.'],
            ['projects_pro_title', 'Professional Systems', 'الأنظمة الاحترافية'],
            ['projects_live_title', 'Live Projects', 'المشاريع الحية'],
            ['projects_restricted', 'Restricted - Login Required', 'مقيد - تسجيل الدخول مطلوب'],
            ['btn_view_live', 'View Live', 'عرض مباشر'],
            ['proj_server_title', 'Server Management Dashboard', 'لوحة إدارة الخوادم'],
            ['proj_webmail_title', 'Secure Webmail Client', 'عميل بريد إلكتروني آمن'],
            ['proj_crm_title', 'Enterprise CRM Platform', 'منصة CRM للمؤسسات'],
            ['proj_fashion_title', 'Fashion Hub E-Commerce', 'متجر أزياء إلكتروني'],
            ['proj_travel_title', 'Travel Booking Portal', 'بوابة حجز السفر'],
            ['proj_chatbot_title', 'AI Chatbot Application', 'تطبيق روبوت محادثة ذكي'],
            ['proj_data_title', 'Data Visualization Dashboard', 'لوحة تصور البيانات'],
            ['journey_heading', 'JOURNEY & UPDATES', 'الرحلة والتحديثات'],
            ['journey_subtitle', 'A timeline of professional milestones.', 'جدول زمني للإنجازات المهنية.'],
            ['journey_tag_project', 'PROJECT', 'مشروع'],
            ['journey_1_title', 'Launched "Apex Finance" Platform', 'إطلاق منصة "أبيكس فاينانس"'],
            ['journey_2_title', 'Promoted to Senior Software Engineer', 'ترقية إلى مهندس برمجيات أول'],
            ['contact_heading', 'CONTACT', 'اتصل بنا'],
            ['contact_subtitle', 'Get in touch', 'تواصل معنا'],
            ['contact_email', 'om.he.els@gmail.com', 'om.he.els@gmail.com'],
            ['contact_github', 'github.com/omarelsayed', 'github.com/omarelsayed'],
            ['contact_linkedin', 'linkedin.com/in/omarelsayed', 'linkedin.com/in/omarelsayed'],
            ['form_name', 'Name', 'الاسم'],
            ['form_email', 'Email', 'البريد الإلكتروني'],
            ['form_message', 'Message', 'الرسالة'],
            ['form_submit', 'SEND MESSAGE', 'إرسال الرسالة'],
            ['contact_success', 'Message sent successfully!', 'تم إرسال الرسالة بنجاح!'],
            ['footer_rights', 'All Rights Reserved.', 'جميع الحقوق محفوظة.'],
        ];

        $stmt = $db->prepare("INSERT INTO translations (msgid, en, ar) VALUES (?, ?, ?)");
        foreach ($translations as $t) {
            $stmt->execute($t);
        }
    }

    // Seed Admin User
    $adminCount = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
    if ($adminCount == 0) {
        $username = 'admin';
        $email = 'om.he.els@gmail.com';
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
    }

} catch (PDOException $e) {
    // If it's a connection error, it might be because the DB container isn't ready yet
    // In a real app, we'd handle this more gracefully
    die("Database connection failed: " . $e->getMessage());
}
