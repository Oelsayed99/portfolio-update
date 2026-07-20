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

$host = getenv('DB_HOST') !== false ? getenv('DB_HOST') : 'localhost';
$name = getenv('DB_NAME') !== false ? getenv('DB_NAME') : 'portfolio';
$user = getenv('DB_USER') !== false ? getenv('DB_USER') : 'root';
$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : 'root';

try {
    // Initial connection to ensure DB exists and create tables
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8mb4");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$name` ");

    // Fast-path: If database is already initialized, skip schema creation & seeding overhead
    if ($pdo->query("SHOW TABLES LIKE 'translations'")->fetch()) {
        return;
    }

    // Check if tables already exist to control seeding
    $shouldSeedProjects = !$pdo->query("SHOW TABLES LIKE 'projects'")->fetch();
    $shouldSeedJourney = !$pdo->query("SHOW TABLES LIKE 'journey'")->fetch();
    $shouldSeedSkills = !$pdo->query("SHOW TABLES LIKE 'skills'")->fetch();

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

    // Create project_sections table
    $pdo->exec("CREATE TABLE IF NOT EXISTS project_sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name_en VARCHAR(255) NOT NULL,
        name_ar VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        description_en TEXT,
        description_ar TEXT,
        display_order INT DEFAULT 0,
        active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create project_statuses table
    $pdo->exec("CREATE TABLE IF NOT EXISTS project_statuses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name_en VARCHAR(255) NOT NULL,
        name_ar VARCHAR(255) NOT NULL,
        icon VARCHAR(255) DEFAULT '',
        color VARCHAR(255) DEFAULT '',
        display_order INT DEFAULT 0,
        active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create technologies table
    $pdo->exec("CREATE TABLE IF NOT EXISTS technologies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        icon VARCHAR(255) DEFAULT '',
        color VARCHAR(255) DEFAULT '',
        category ENUM('frontend', 'backend', 'database', 'devops', 'tools') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create tags table
    $pdo->exec("CREATE TABLE IF NOT EXISTS tags (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name_en VARCHAR(255) NOT NULL,
        name_ar VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create projects table
    $pdo->exec("CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title_en VARCHAR(255) NOT NULL,
        title_ar VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        section_id INT NOT NULL,
        status_id INT NOT NULL,
        featured_order INT DEFAULT NULL,
        visibility ENUM('draft', 'published', 'archived') DEFAULT 'published',
        thumbnail VARCHAR(255) DEFAULT '',
        hero_image VARCHAR(255) DEFAULT '',
        short_description_en TEXT,
        short_description_ar TEXT,
        description_en TEXT,
        description_ar TEXT,
        problem_en TEXT,
        problem_ar TEXT,
        solution_en TEXT,
        solution_ar TEXT,
        architecture_en TEXT,
        architecture_ar TEXT,
        challenges_en TEXT,
        challenges_ar TEXT,
        lessons_learned_en TEXT,
        lessons_learned_ar TEXT,
        my_role_en TEXT,
        my_role_ar TEXT,
        company_en VARCHAR(255) DEFAULT '',
        company_ar VARCHAR(255) DEFAULT '',
        client_en VARCHAR(255) DEFAULT '',
        client_ar VARCHAR(255) DEFAULT '',
        duration_en VARCHAR(255) DEFAULT '',
        duration_ar VARCHAR(255) DEFAULT '',
        team_size INT DEFAULT 1,
        contribution_percentage INT DEFAULT 100,
        countries_used TEXT,
        user_count INT DEFAULT 0,
        performance_score INT DEFAULT 90,
        completion_percentage INT DEFAULT 100,
        display_order INT DEFAULT 0,
        seo_title_en VARCHAR(255) DEFAULT '',
        seo_title_ar VARCHAR(255) DEFAULT '',
        seo_description_en TEXT,
        seo_description_ar TEXT,
        canonical_url VARCHAR(255) DEFAULT '',
        og_image VARCHAR(255) DEFAULT '',
        twitter_image VARCHAR(255) DEFAULT '',
        keywords TEXT,
        structured_data TEXT,
        project_url VARCHAR(255) DEFAULT '',
        github_url VARCHAR(255) DEFAULT '',
        case_study_url VARCHAR(255) DEFAULT '',
        demo_url VARCHAR(255) DEFAULT '',
        docs_url VARCHAR(255) DEFAULT '',
        figma_url VARCHAR(255) DEFAULT '',
        video_url VARCHAR(255) DEFAULT '',
        showcase_video VARCHAR(255) DEFAULT '',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (section_id) REFERENCES project_sections(id) ON DELETE RESTRICT,
        FOREIGN KEY (status_id) REFERENCES project_statuses(id) ON DELETE RESTRICT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Migration: Add short_description columns if they do not exist
    try {
        $pdo->exec("ALTER TABLE projects ADD COLUMN short_description_en TEXT AFTER hero_image");
    } catch (PDOException $e) {}
    try {
        $pdo->exec("ALTER TABLE projects ADD COLUMN short_description_ar TEXT AFTER short_description_en");
    } catch (PDOException $e) {}

    // Create project_images table
    $pdo->exec("CREATE TABLE IF NOT EXISTS project_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        project_id INT NOT NULL,
        image VARCHAR(255) NOT NULL,
        alt_text_en VARCHAR(255) DEFAULT '',
        alt_text_ar VARCHAR(255) DEFAULT '',
        caption_en VARCHAR(255) DEFAULT '',
        caption_ar VARCHAR(255) DEFAULT '',
        display_order INT DEFAULT 0,
        featured TINYINT(1) DEFAULT 0,
        FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create project_technologies table
    $pdo->exec("CREATE TABLE IF NOT EXISTS project_technologies (
        project_id INT NOT NULL,
        technology_id INT NOT NULL,
        PRIMARY KEY (project_id, technology_id),
        FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
        FOREIGN KEY (technology_id) REFERENCES technologies(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create project_tags table
    $pdo->exec("CREATE TABLE IF NOT EXISTS project_tags (
        project_id INT NOT NULL,
        tag_id INT NOT NULL,
        PRIMARY KEY (project_id, tag_id),
        FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
        FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create media table
    $pdo->exec("CREATE TABLE IF NOT EXISTS media (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL,
        filepath VARCHAR(255) NOT NULL,
        file_type VARCHAR(50) NOT NULL,
        file_size INT NOT NULL,
        folder VARCHAR(255) DEFAULT 'uploads',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

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
            ['skill_devops', 'DevOps', 'ديف أوبس'],
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
    if ($shouldSeedProjects) {
        $projects = [
            ['Server Management Dashboard', 'لوحة إدارة الخوادم', 'server-management-dashboard', 2, 1, '', 'Server Management Dashboard description en', 'وصف لوحة إدارة الخوادم'],
            ['Secure Webmail Client', 'عميل بريد إلكتروني آمن', 'secure-webmail-client', 2, 1, '', 'Secure Webmail Client description en', 'وصف عميل بريد إلكتروني آمن'],
            ['Enterprise CRM Platform', 'منصة CRM للمؤسسات', 'enterprise-crm-platform', 2, 1, '', 'Enterprise CRM Platform description en', 'وصف منصة CRM للمؤسسات'],
            ['Fashion Hub E-Commerce', 'متجر أزياء إلكتروني', 'fashion-hub-e-commerce', 3, 1, '/assets/images/proj_fashion.png', 'Fashion Hub description en', 'وصف متجر أزياء إلكتروني'],
            ['Travel Booking Portal', 'بوابة حجز السفر', 'travel-booking-portal', 3, 1, '/assets/images/proj_travel.png', 'Travel Booking description en', 'وصف بوابة حجز السفر'],
            ['AI Chatbot Application', 'تطبيق روبوت محادثة ذكي', 'ai-chatbot-application', 5, 2, '/assets/images/proj_chatbot.png', 'AI Chatbot description en', 'وصف تطبيق روبوت محادثة ذكي'],
            ['Data Visualization Dashboard', 'لوحة تصور البيانات', 'data-visualization-dashboard', 6, 1, '/assets/images/proj_data.png', 'Data Visualization description en', 'وصف لوحة تصور البيانات']
        ];
        $stmt = $db->prepare("INSERT INTO projects (title_en, title_ar, slug, section_id, status_id, thumbnail, description_en, description_ar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($projects as $p) {
            $stmt->execute($p);
        }
    }

    // Seed Journey
    if ($shouldSeedJourney) {
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
    if ($shouldSeedSkills) {
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
            ['devops', 'Docker', 'Docker', 1],
            ['devops', 'Linux', 'Linux', 2],
            ['devops', 'Git', 'Git', 3],
            ['devops', 'GitHub', 'GitHub', 4],
            ['devops', 'VPS Deployment', 'VPS Deployment', 5],
            ['devops', 'Cloudflare', 'Cloudflare', 6],
            ['devops', 'Nginx/OpenLiteSpeed', 'Nginx/OpenLiteSpeed', 7],
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
