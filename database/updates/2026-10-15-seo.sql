-- SEO titles/descriptions per page + 404 copy (INSERT IGNORE keeps later edits)
SET NAMES utf8mb4;
INSERT IGNORE INTO translations (msgid, en, ar) VALUES
('seo_title_home', 'Omar Elsayed — Software Engineer in Dubai · AI Systems & Automation', 'عمر السيد — مهندس برمجيات في دبي · أنظمة الذكاء الاصطناعي والأتمتة'),
('seo_desc_home', 'Omar Elsayed is a software engineer and Tech Lead in Dubai who builds production web systems, AI tools and automation, in English and Arabic.', 'عمر السيد مهندس برمجيات وقائد تقني في دبي، يبني أنظمة ويب جاهزة للإنتاج وأدوات ذكاء اصطناعي وأتمتة، بالعربية والإنجليزية.'),
('seo_title_about', 'About Omar Elsayed — Software Engineer & Tech Lead, Dubai', 'نبذة عن عمر السيد — مهندس برمجيات وقائد تقني، دبي'),
('seo_desc_about', 'From Egypt to India to Dubai: Omar Elsayed''s experience, skills in PHP, Laravel, JavaScript and AI, and how he builds software.', 'من مصر إلى الهند إلى دبي: خبرة عمر السيد ومهاراته في PHP وLaravel وJavaScript والذكاء الاصطناعي، وطريقته في بناء البرمجيات.'),
('seo_title_services', 'Web Development, AI & Automation Services in Dubai | Omar Elsayed', 'خدمات تطوير الويب والذكاء الاصطناعي والأتمتة في دبي | عمر السيد'),
('seo_desc_services', 'Custom web applications, AI features and n8n automation, bilingual Arabic/English sites and CMS, hosting and maintenance, from one engineer.', 'تطبيقات ويب مخصصة، وخصائص ذكاء اصطناعي وأتمتة n8n، ومواقع ثنائية اللغة مع نظام إدارة محتوى، والاستضافة والصيانة، من مهندس واحد.'),
('seo_title_projects', 'Projects & Case Studies | Omar Elsayed', 'المشاريع ودراسات الحالة | عمر السيد'),
('seo_desc_projects', 'Production systems, AI tools and client work by Omar Elsayed: PitchProof, MonyMonk, YaxiGo, Super Speed and more, with case studies.', 'أنظمة إنتاجية وأدوات ذكاء اصطناعي وأعمال للعملاء من عمر السيد: PitchProof وMonyMonk وYaxiGo وSuper Speed وغيرها، مع دراسات الحالة.'),
('seo_title_blog', 'My Journey: Egypt, India, Dubai | Omar Elsayed', 'رحلتي: مصر، الهند، دبي | عمر السيد'),
('seo_desc_blog', 'The story and milestones of Omar Elsayed: freelancing in Egypt, AI research in India, the first engineer at ALL-INKL in Dubai, and Tech Lead today.', 'قصة ومحطات عمر السيد: العمل الحر في مصر، وأبحاث الذكاء الاصطناعي في الهند، وأول مهندس في ALL-INKL بدبي، وقائد تقني اليوم.'),
('seo_title_contact', 'Contact Omar Elsayed — Hire a Software Engineer in Dubai', 'تواصل مع عمر السيد — مهندس برمجيات في دبي'),
('seo_desc_contact', 'Get in touch about a web app, AI or automation project, or a role. Based in Dubai, working remotely in any time zone.', 'تواصل بخصوص تطبيق ويب أو مشروع ذكاء اصطناعي أو أتمتة أو وظيفة. مقيم في دبي وأعمل عن بُعد في أي منطقة زمنية.'),
('seo_case_study', 'Case study', 'دراسة حالة'),
('seo_title_404', 'Page not found | Omar Elsayed', 'الصفحة غير موجودة | عمر السيد'),
('seo_desc_404', 'This page does not exist.', 'هذه الصفحة غير موجودة.'),
('notfound_title', 'This page doesn''t exist.', 'هذه الصفحة غير موجودة.'),
('notfound_text', 'The link may be old or mistyped. Try the home page or my projects.', 'ربما يكون الرابط قديمًا أو به خطأ. جرّب الصفحة الرئيسية أو مشاريعي.');
