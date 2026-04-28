-- Translations Table Structure
CREATE TABLE IF NOT EXISTS translations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    msgid TEXT UNIQUE,
    en TEXT,
    ar TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Example Translation Records
INSERT OR IGNORE INTO translations (msgid, en, ar) VALUES 
('nav_home', 'Home', 'الرئيسية'),
('nav_about', 'About', 'من أنا'),
('nav_projects', 'Projects', 'المشاريع'),
('nav_blog', 'Journey & Updates', 'رحلتي وتحديثاتي'),
('nav_contact', 'Contact', 'اتصل بي'),
('hero_hello', "Hello, I'm", 'مرحباً، أنا'),
('hero_name', 'Omar Elsayed', 'عمر السيد'),
('hero_title', 'Software Engineer & Full-Stack Developer', 'مهندس برمجيات ومطور شامل'),
('hero_desc', 'Creating innovative and scalable web applications with a focus on user experience and performance.', 'إنشاء تطبيقات ويب مبتكرة وقابلة للتطوير مع التركيز على تجربة المستخدم والأداء.'),
('btn_hire', 'Hire Me', 'وظفني'),
('btn_projects', 'View Projects', 'عرض المشاريع'),
('about_title', 'About Me', 'من أنا'),
('about_desc', "I'm a passionate designer & developer.", 'أنا مصمم ومطور شغوف.'),
('projects_title', 'My Projects', 'مشاريعي'),
('projects_desc', 'A selection of my best work.', 'مجموعة مختارة من أفضل أعمالي.'),
('contact_title', 'Get In Touch', 'تواصل معي'),
('contact_desc', "Let's build something amazing together.", 'فلنبنِ شيئاً مذهلاً معاً.'),
('form_name', 'Name', 'الاسم'),
('form_email', 'Email', 'البريد الإلكتروني'),
('form_message', 'Message', 'الرسالة'),
('form_submit', 'Send Message', 'إرسال الرسالة'),
('footer_rights', 'All rights reserved.', 'جميع الحقوق محفوظة.'),
('lang_en', 'English', 'الإنجليزية'),
('lang_ar', 'Arabic', 'العربية');
