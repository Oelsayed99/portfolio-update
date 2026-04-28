<?php

/**
 * Database Connection & Initialization
 * 
 * Uses SQLite for simplicity.
 * Creates the translations table and seeds it with all required
 * English and Arabic translations for every page.
 */

try {
    $dbPath = BASE_PATH . '/database.sqlite';
    $db = new PDO("sqlite:$dbPath");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create translations table
    $db->exec("CREATE TABLE IF NOT EXISTS translations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        msgid TEXT UNIQUE,
        en TEXT,
        ar TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Seed translations if empty
    $count = $db->query("SELECT COUNT(*) FROM translations")->fetchColumn();
    if ($count == 0) {
        $translations = [
            // ── Navigation ──
            ['nav_home', 'Home', 'الرئيسية'],
            ['nav_about', 'About', 'من أنا'],
            ['nav_projects', 'Projects', 'المشاريع'],
            ['nav_blog', 'Journey & Updates', 'رحلتي وتحديثاتي'],
            ['nav_contact', 'Contact', 'اتصل بي'],
            ['nav_work', 'Work', 'الأعمال'],
            ['nav_services', 'Services', 'الخدمات'],
            ['nav_get_in_touch', 'Get in Touch', 'تواصل معي'],

            // ── Home / Hero ──
            ['hero_hello', "Hello, I'm", 'مرحباً، أنا'],
            ['hero_name', 'Omar Elsayed', 'عمر السيد'],
            ['hero_name_upper', 'OMAR ELSAYED', 'عمر السيد'],
            ['hero_title', 'Software Engineer & Full-Stack Developer', 'مهندس برمجيات ومطور شامل'],
            ['hero_desc', 'Creating innovative and scalable web applications with a focus on user experience and performance.', 'إنشاء تطبيقات ويب مبتكرة وقابلة للتطوير مع التركيز على تجربة المستخدم والأداء.'],
            ['btn_hire', 'Hire Me', 'وظفني'],
            ['btn_projects', 'View Projects', 'عرض المشاريع'],

            // ── About Page ──
            ['about_heading', 'About Omar.', 'عن عمر.'],
            ['about_subtitle', 'Crafting High-Performance Backend Systems', 'تطوير أنظمة خلفية عالية الأداء'],
            ['about_pro_story_title', 'Professional Story', 'القصة المهنية'],
            ['about_pro_story', "My journey in software engineering began with a fascination for complex problem-solving and building scalable architectures. Over the years, I've honed my expertise in developing robust, enterprise-grade applications that drive business growth. My focus is on creating efficient, maintainable code that stands the test of time.", 'بدأت رحلتي في هندسة البرمجيات بشغف بحل المشكلات المعقدة وبناء هياكل قابلة للتطوير. على مر السنين، صقلت خبرتي في تطوير تطبيقات قوية على مستوى المؤسسات تدفع نمو الأعمال. تركيزي على إنشاء كود فعال وقابل للصيانة يصمد أمام اختبار الزمن.'],
            ['about_arch_title', 'Backend Architecture & Performance', 'هندسة الخلفية والأداء'],
            ['about_arch_desc', 'I specialize in designing and implementing high-throughput backend systems. My approach prioritizes performance optimization, data integrity, and secure API development. I build architectures that are resilient, scalable, and optimized for minimal latency.', 'أتخصص في تصميم وتنفيذ أنظمة خلفية عالية الإنتاجية. يعطي منهجي الأولوية لتحسين الأداء وسلامة البيانات وتطوير واجهات برمجة التطبيقات الآمنة. أبني هياكل مرنة وقابلة للتطوير ومحسنة لأقل زمن استجابة.'],
            ['about_skills_title', 'Skills & Expertise', 'المهارات والخبرات'],
            ['skill_backend', 'Backend', 'الخلفية'],
            ['skill_frontend', 'Frontend', 'الواجهة'],
            ['skill_database', 'Database', 'قواعد البيانات'],

            // ── Projects Page ──
            ['projects_heading', 'Portfolio Projects', 'مشاريع المحفظة'],
            ['projects_subtitle', 'Exploring a range of professional and live software engineering work.', 'استكشاف مجموعة من الأعمال الهندسية البرمجية المهنية والحية.'],
            ['projects_pro_title', 'Professional Systems', 'الأنظمة الاحترافية'],
            ['projects_live_title', 'Live Projects', 'المشاريع الحية'],
            ['projects_restricted', 'Restricted - Login Required', 'مقيد - تسجيل الدخول مطلوب'],
            ['btn_view_live', 'View Live', 'عرض مباشر'],

            // Professional Projects
            ['proj_server_title', 'Server Management Dashboard', 'لوحة إدارة الخوادم'],
            ['proj_server_tech', 'Linux, Docker, Kubernetes, Prometheus', 'لينكس، دوكر، كوبرنتس، بروميثيوس'],
            ['proj_webmail_title', 'Secure Webmail Client', 'عميل بريد إلكتروني آمن'],
            ['proj_webmail_tech', 'React, Node.js, PostgreSQL, OAuth 2.0', 'ريأكت، نود، بوستغريس، OAuth 2.0'],
            ['proj_crm_title', 'Enterprise CRM Platform', 'منصة CRM للمؤسسات'],
            ['proj_crm_tech', 'Angular, Python/Django, AWS, Redis', 'أنجولار، بايثون/جانغو، AWS، ريديس'],

            // Live Projects
            ['proj_fashion_title', 'Fashion Hub E-Commerce', 'متجر أزياء إلكتروني'],
            ['proj_fashion_desc', 'Responsive online store with cart and payment.', 'متجر إلكتروني متجاوب مع سلة تسوق ودفع.'],
            ['proj_travel_title', 'Travel Booking Portal', 'بوابة حجز السفر'],
            ['proj_travel_desc', 'Search and book flights and hotels in real-time.', 'ابحث واحجز الرحلات والفنادق في الوقت الفعلي.'],
            ['proj_chatbot_title', 'AI Chatbot Application', 'تطبيق روبوت محادثة ذكي'],
            ['proj_chatbot_desc', 'Intelligent conversational agent using NLP.', 'وكيل محادثة ذكي يستخدم معالجة اللغة الطبيعية.'],
            ['proj_data_title', 'Data Visualization Dashboard', 'لوحة تصور البيانات'],
            ['proj_data_desc', 'Interactive data analysis tool with real-time metrics.', 'أداة تحليل بيانات تفاعلية مع مقاييس في الوقت الفعلي.'],

            // ── Journey & Updates Page ──
            ['journey_heading', 'JOURNEY & UPDATES', 'الرحلة والتحديثات'],
            ['journey_subtitle', 'A timeline of professional milestones, projects, and continuous learning.', 'جدول زمني للإنجازات المهنية والمشاريع والتعلم المستمر.'],
            ['journey_tag_project', 'PROJECT', 'مشروع'],
            ['journey_tag_career', 'CAREER', 'مسار مهني'],
            ['journey_tag_cert', 'CERTIFICATION', 'شهادة'],
            ['journey_tag_learning', 'LEARNING', 'تعلم'],

            // Timeline entries
            ['journey_1_title', 'Launched "Apex Finance" Platform', 'إطلاق منصة "أبيكس فاينانس"'],
            ['journey_1_date', 'October 2023', 'أكتوبر 2023'],
            ['journey_1_desc', 'Lead developer for a complex fintech application, delivering a scalable and secure architecture. The project was successfully deployed to over 10,000 active users.', 'المطور الرئيسي لتطبيق تكنولوجيا مالية معقد، يقدم هيكلًا قابلًا للتطوير وآمنًا. تم نشر المشروع بنجاح لأكثر من 10,000 مستخدم نشط.'],

            ['journey_2_title', 'Promoted to Senior Software Engineer', 'ترقية إلى مهندس برمجيات أول'],
            ['journey_2_date', 'June 2023', 'يونيو 2023'],
            ['journey_2_desc', 'Recognized for technical leadership and mentoring junior team members at TechNova Solutions.', 'تم الاعتراف بالقيادة التقنية وتوجيه أعضاء الفريق المبتدئين في TechNova Solutions.'],

            ['journey_3_title', 'AWS Certified Solutions Architect – Associate', 'شهادة AWS Solutions Architect – Associate'],
            ['journey_3_date', 'March 2023', 'مارس 2023'],
            ['journey_3_desc', 'Validated expertise in designing distributed systems on AWS. Continuous commitment to cloud technologies.', 'خبرة موثقة في تصميم الأنظمة الموزعة على AWS. التزام مستمر بتقنيات السحابة.'],

            ['journey_4_title', 'Completed Advanced Machine Learning Specialization', 'إكمال تخصص التعلم الآلي المتقدم'],
            ['journey_4_date', 'January 2023', 'يناير 2023'],
            ['journey_4_desc', 'Deep dive into deep learning, convolutional networks, and sequence models through Coursera.', 'الغوص العميق في التعلم العميق والشبكات الالتفافية ونماذج التسلسل عبر كورسيرا.'],

            // ── Contact Page ──
            ['contact_heading', 'CONTACT', 'اتصل بنا'],
            ['contact_subtitle', 'Get in touch', 'تواصل معنا'],
            ['contact_email', 'om.he.els@gmail.com', 'om.he.els@gmail.com'],
            ['contact_github', 'github.com/omarelsayed', 'github.com/omarelsayed'],
            ['contact_linkedin', 'linkedin.com/in/omarelsayed', 'linkedin.com/in/omarelsayed'],
            ['form_name', 'Name', 'الاسم'],
            ['form_name_placeholder', 'John Doe', 'أدخل اسمك'],
            ['form_email', 'Email', 'البريد الإلكتروني'],
            ['form_email_placeholder', 'john@example.com', 'بريدك الإلكتروني'],
            ['form_message', 'Message', 'الرسالة'],
            ['form_submit', 'SEND MESSAGE', 'إرسال الرسالة'],
            ['contact_success', 'Message sent successfully!', 'تم إرسال الرسالة بنجاح!'],

            // ── Footer ──
            ['footer_rights', 'All Rights Reserved.', 'جميع الحقوق محفوظة.'],
        ];

        $stmt = $db->prepare("INSERT INTO translations (msgid, en, ar) VALUES (?, ?, ?)");
        foreach ($translations as $t) {
            $stmt->execute($t);
        }
    }

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
