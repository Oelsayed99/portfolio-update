-- Seed Project Sections
INSERT INTO project_sections (name_en, name_ar, slug, description_en, description_ar, display_order, active) VALUES
('Featured Projects', 'المشاريع المميزة', 'featured', 'Featured applications showcasing high-level development.', 'تطبيقات مميزة تعرض تطويرًا عالي المستوى.', 1, 1),
('Professional Projects', 'المشاريع المهنية', 'professional', 'Production systems developed professionally.', 'أنظمة إنتاج تم تطويرها بشكل احترافي.', 2, 1),
('Personal Projects', 'المشاريع الشخصية', 'personal', 'Independent applications built from scratch.', 'تطبيقات مستقلة تم بناؤها من الصفر.', 3, 1),
('Open Source & GitHub', 'مشاريع مفتوحة المصدر', 'opensource', 'Publicly available tools and libraries.', 'أدوات ومكتبات متاحة للعامة.', 4, 1),
('Currently Building', 'مشاريع قيد التطوير', 'building', 'Projects currently in active development.', 'مشاريع حاليًا قيد التطوير النشط.', 5, 1),
('Experiments & Learning', 'تجارب وتعلم', 'experiments', 'Prototypes and technical experiments.', 'نماذج أولية وتجارب تقنية.', 6, 1);

-- Seed Project Statuses
INSERT INTO project_statuses (name_en, name_ar, icon, color, display_order, active) VALUES
('Completed', 'مكتمل', 'fa-circle-check', '#22c55e', 1, 1),
('In Progress', 'قيد التطوير', 'fa-spinner', '#a855f7', 2, 1),
('Maintenance', 'صيانة', 'fa-wrench', '#f59e0b', 3, 1),
('Paused', 'متوقف مؤقتاً', 'fa-circle-pause', '#6b7280', 4, 1),
('Archived', 'مؤرشف', 'fa-box-archive', '#ef4444', 5, 1);

-- Seed Technologies
INSERT INTO technologies (name, icon, color, category) VALUES
('PHP', 'fab fa-php', '#777bb4', 'backend'),
('Laravel', 'fab fa-laravel', '#ff2d20', 'backend'),
('Symfony', 'fab fa-symfony', '#000000', 'backend'),
('Node.js', 'fab fa-node-js', '#339933', 'backend'),
('Go', 'fa-brands fa-golang', '#00add8', 'backend'),
('JavaScript', 'fab fa-js', '#f7df1e', 'frontend'),
('React', 'fab fa-react', '#61dafb', 'frontend'),
('Vue.js', 'fab fa-vuejs', '#4fc08d', 'frontend'),
('HTML5/CSS3', 'fab fa-html5', '#e34f26', 'frontend'),
('SQL', 'fas fa-database', '#00758f', 'database'),
('MySQL', 'fas fa-server', '#4479a1', 'database'),
('PostgreSQL', 'fas fa-database', '#336791', 'database'),
('Redis', 'fas fa-server', '#d82c20', 'database'),
('MongoDB', 'fas fa-leaf', '#47a248', 'database'),
('Docker', 'fab fa-docker', '#2496ed', 'devops'),
('Linux', 'fab fa-linux', '#f82020', 'devops'),
('Git', 'fab fa-git-alt', '#f05032', 'devops'),
('GitHub', 'fab fa-github', '#181717', 'devops'),
('VPS Deployment', 'fas fa-cloud-server', '#0080ff', 'devops'),
('Cloudflare', 'fab fa-cloudflare', '#f38020', 'devops'),
('Nginx/OpenLiteSpeed', 'fas fa-network-wired', '#009639', 'devops');

-- Seed Tags
INSERT INTO tags (name_en, name_ar, slug) VALUES
('Web App', 'تطبيق ويب', 'web-app'),
('Mobile API', 'واجهة برمجة تطبيقات الهاتف', 'mobile-api'),
('CRM', 'إدارة علاقات العملاء', 'crm'),
('Fintech', 'التكنولوجيا المالية', 'fintech'),
('Dashboard', 'لوحة تحكم', 'dashboard');
