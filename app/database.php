<?php

use app\models\Translation;
use app\models\User;

/**
 * Database Initialization for MySQL
 */

// Load .env file if it exists (for non-Docker environments like CyberPanel)
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (!getenv($key)) {
            putenv("$key=$value");
        }
    }
}

$host = getenv('DB_HOST') ?: 'localhost';
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

    // Create projects table
    $pdo->exec("CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        type ENUM('pro', 'live') NOT NULL,
        title_en VARCHAR(255),
        title_ar VARCHAR(255),
        tech_en VARCHAR(255),
        tech_ar VARCHAR(255),
        description_en TEXT,
        description_ar TEXT,
        image VARCHAR(255),
        link VARCHAR(255),
        icons TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // Create journey table
    $pdo->exec("CREATE TABLE IF NOT EXISTS journey (
        id INT AUTO_INCREMENT PRIMARY KEY,
        date_en VARCHAR(255),
        date_ar VARCHAR(255),
        title_en VARCHAR(255),
        title_ar VARCHAR(255),
        description_en TEXT,
        description_ar TEXT,
        tag_en VARCHAR(255),
        tag_ar VARCHAR(255),
        tag_type VARCHAR(50),
        side ENUM('left', 'right') DEFAULT 'left',
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // Create skills table
    $pdo->exec("CREATE TABLE IF NOT EXISTS skills (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category VARCHAR(50) NOT NULL,
        name_en VARCHAR(255) NOT NULL,
        name_ar VARCHAR(255),
        sort_order INT DEFAULT 0,
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
            ['contact_github', 'github.com/Oelsayed99', 'github.com/Oelsayed99'],
            ['contact_linkedin', 'linkedin.com/in/omar-elsayed-1162ab1b0', 'linkedin.com/in/omar-elsayed-1162ab1b0'],

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

    // Seed Projects
    $projCount = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
    if ($projCount == 0) {
        $projects = [
            ['pro', 'Server Management Dashboard', 'لوحة إدارة الخوادم', 'Linux, Docker, Kubernetes', 'لينكس، دوكر، كوبرنيتس', '', '', '', '', 'fab fa-linux, fab fa-docker, fas fa-dharmachakra, fas fa-chart-line'],
            ['pro', 'Secure Webmail Client', 'عميل بريد إلكتروني آمن', 'React, Node.js, PostgreSQL', 'رياكت، نود جي اس، بوستجري اس كيو ال', '', '', '', '', 'fab fa-react, fab fa-node-js, fas fa-database, fas fa-shield-halved'],
            ['pro', 'Enterprise CRM Platform', 'منصة CRM للمؤسسات', 'Angular, Python, AWS', 'أنجولار، بايثون، أمازون وورلد سيرفيسز', '', '', '', '', 'fab fa-angular, fab fa-python, fab fa-aws'],
            ['live', 'Fashion Hub E-Commerce', 'متجر أزياء إلكتروني', '', '', 'Fashion Hub description en', 'وصف متجر أزياء إلكتروني', '/assets/images/proj_fashion.png', '#', ''],
            ['live', 'Travel Booking Portal', 'بوابة حجز السفر', '', '', 'Travel Booking description en', 'وصف بوابة حجز السفر', '/assets/images/proj_travel.png', '#', ''],
            ['live', 'AI Chatbot Application', 'تطبيق روبوت محادثة ذكي', '', '', 'AI Chatbot description en', 'وصف تطبيق روبوت محادثة ذكي', '/assets/images/proj_chatbot.png', '#', ''],
            ['live', 'Data Visualization Dashboard', 'لوحة تصور البيانات', '', '', 'Data Visualization description en', 'وصف لوحة تصور البيانات', '/assets/images/proj_data.png', '#', '']
        ];
        $stmt = $db->prepare("INSERT INTO projects (type, title_en, title_ar, tech_en, tech_ar, description_en, description_ar, image, link, icons) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($projects as $p) {
            $stmt->execute($p);
        }
    }

    // Seed Journey
    $journeyCount = $db->query("SELECT COUNT(*) FROM journey")->fetchColumn();
    if ($journeyCount == 0) {
        $journey = [
            ['2023', '2023', 'Launched "Apex Finance" Platform', 'إطلاق منصة "أبيكس فاينانس"', 'Apex Finance description en', 'وصف منصة أبيكس فاينانس', 'PROJECT', 'مشروع', 'project', 'left', '/assets/images/journey_apex.png'],
            ['2022', '2022', 'Promoted to Senior Software Engineer', 'ترقية إلى مهندس برمجيات أول', 'Promotion description en', 'وصف الترقية', 'CAREER', 'مسيرة', 'career', 'right', ''],
            ['2021', '2021', 'AWS Certified Solutions Architect', 'شهادة مهندس حلول معتمد من AWS', 'AWS Cert description en', 'وصف شهادة AWS', 'CERTIFICATION', 'شهادة', 'cert', 'left', ''],
            ['2020', '2020', 'Machine Learning Specialization', 'تخصص في تعلم الآلة', 'ML Specialization description en', 'وصف تخصص تعلم الآلة', 'LEARNING', 'تعلم', 'learning', 'right', '']
        ];
        $stmt = $db->prepare("INSERT INTO journey (date_en, date_ar, title_en, title_ar, description_en, description_ar, tag_en, tag_ar, tag_type, side, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($journey as $j) {
            $stmt->execute($j);
        }
    }

    // Seed Skills
    $skillCount = $db->query("SELECT COUNT(*) FROM skills")->fetchColumn();
    if ($skillCount == 0) {
        $skills = [
            ['backend', 'PHP', 'PHP', 1],
            ['backend', 'Laravel', 'Laravel', 2],
            ['backend', 'Symfony', 'Symfony', 3],
            ['backend', 'Node.js', 'Node.js', 4],
            ['backend', 'Go', 'Go', 5],
            ['frontend', 'JavaScript', 'JavaScript', 1],
            ['frontend', 'React', 'React', 2],
            ['frontend', 'Vue.js', 'Vue.js', 3],
            ['frontend', 'HTML5/CSS3', 'HTML5/CSS3', 4],
            ['database', 'SQL', 'SQL', 1],
            ['database', 'MySQL', 'MySQL', 2],
            ['database', 'PostgreSQL', 'PostgreSQL', 3],
            ['database', 'Redis', 'Redis', 4],
            ['database', 'MongoDB', 'MongoDB', 5],
        ];
        $stmt = $db->prepare("INSERT INTO skills (category, name_en, name_ar, sort_order) VALUES (?, ?, ?, ?)");
        foreach ($skills as $s) {
            $stmt->execute($s);
        }
    }

} catch (PDOException $e) {
    // If it's a connection error, it might be because the DB container isn't ready yet
    // In a real app, we'd handle this more gracefully
    die("Database connection failed: " . $e->getMessage());
}
