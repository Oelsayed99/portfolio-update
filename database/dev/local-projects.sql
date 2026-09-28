-- LOCAL ONLY. Mirrors the live site after 2026-09-27-projects.sql: live snapshot + new projects.
SET NAMES utf8mb4;
DELETE FROM projects;
INSERT INTO technologies (name, icon, color, category) SELECT 'TypeScript','fas fa-code','#3178c6','frontend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='TypeScript');
INSERT INTO technologies (name, icon, color, category) SELECT 'Next.js','fas fa-n','#ffffff','frontend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Next.js');
INSERT INTO technologies (name, icon, color, category) SELECT 'Tailwind CSS','fas fa-wind','#38bdf8','frontend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Tailwind CSS');
INSERT INTO technologies (name, icon, color, category) SELECT 'Zod','fas fa-shield-halved','#3068b7','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Zod');
INSERT INTO technologies (name, icon, color, category) SELECT 'Vitest','fas fa-vial-circle-check','#6e9f18','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Vitest');
INSERT INTO technologies (name, icon, color, category) SELECT 'Pest','fas fa-vial','#a855f7','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Pest');
INSERT INTO technologies (name, icon, color, category) SELECT 'Gemini API','fas fa-wand-magic-sparkles','#8e75b2','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Gemini API');
INSERT INTO technologies (name, icon, color, category) SELECT 'Prisma','fas fa-diamond','#5a67d8','database' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Prisma');
INSERT INTO technologies (name, icon, color, category) SELECT 'Python','fab fa-python','#3776ab','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Python');
INSERT INTO technologies (name, icon, color, category) SELECT 'FastAPI','fas fa-bolt','#009688','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='FastAPI');
INSERT INTO technologies (name, icon, color, category) SELECT 'Flask','fas fa-flask','#ffffff','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Flask');
INSERT INTO technologies (name, icon, color, category) SELECT 'SQLite','fas fa-database','#003b57','database' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='SQLite');
INSERT INTO technologies (name, icon, color, category) SELECT 'n8n','fas fa-diagram-project','#ea4b71','devops' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='n8n');
INSERT INTO technologies (name, icon, color, category) SELECT 'TensorFlow','fas fa-brain','#ff6f00','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='TensorFlow');
INSERT INTO technologies (name, icon, color, category) SELECT 'pandas','fas fa-table','#150458','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='pandas');
INSERT INTO technologies (name, icon, color, category) SELECT 'Jupyter','fas fa-book-open','#f37626','backend' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM technologies WHERE name='Jupyter');
INSERT INTO tags (name_en, name_ar, slug) SELECT 'AI','ذكاء اصطناعي','ai' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tags WHERE slug='ai');
INSERT INTO tags (name_en, name_ar, slug) SELECT 'Automation','أتمتة','automation' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tags WHERE slug='automation');
INSERT INTO tags (name_en, name_ar, slug) SELECT 'Data Analysis','تحليل البيانات','data-analysis' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tags WHERE slug='data-analysis');
INSERT INTO tags (name_en, name_ar, slug) SELECT 'Learning','تعلّم','learning' FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM tags WHERE slug='learning');
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,company_en,company_ar,my_role_en,my_role_ar,duration_en,duration_ar,team_size,contribution_percentage,performance_score,user_count,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar,short_description_en,short_description_ar) VALUES ('Flow Egypt','فلو إيجيبت','flow-egypt','3','1',NULL,'published','/assets/images/projects/flow-egypt.webp','/assets/images/projects/flow-egypt-hero.webp','Flow Egypt','فلو إيجيبت','Full Stack Developer & UI/UX Designer','مطور برامج متكامل و مصمم واجهات','2 weeks','','1','100','70','20','100','0','https://flow-egy.com/','https://github.com/Oelsayed99/flow-corporate','Flow Egypt is a corporate website developed for a real estate company to showcase its services, strengthen its online presence, and provide an easy way for potential clients to explore the business and get in touch.



The project was built from the ground up, covering every stage of development—from UI/UX design and application architecture to deployment, email configuration, and production launch.','موقع Flow Egypt هو موقع إلكتروني مصمم خصيصًا لشركة عقارية لعرض خدماتها، وتعزيز حضورها الرقمي، وتوفير طريقة سهلة للعملاء المحتملين لاستكشاف أعمالها والتواصل معها.



تم بناء المشروع من الصفر، وشمل جميع مراحل التطوير، بدءًا من تصميم واجهة المستخدم وتجربة المستخدم، وهيكلة التطبيق، وصولًا إلى النشر، وإعداد البريد الإلكتروني، وإطلاق الموقع رسميًا.','Flow Egypt needed a modern, professional website that reflected the company''s brand, presented its services clearly, and supported both Arabic- and English-speaking audiences. The solution also needed to be easy to maintain and responsive across all devices.','كانت شركة فلو إيجيبت بحاجة إلى موقع إلكتروني عصري واحترافي يعكس هوية الشركة، ويعرض خدماتها بوضوح، ويدعم الجمهور الناطق باللغتين العربية والإنجليزية. كما كان من الضروري أن يكون الموقع سهل الصيانة ومتوافقًا مع جميع الأجهزة.','I designed and developed a complete custom web application using Laravel and Tailwind CSS, implementing a bilingual user experience, responsive layouts, dynamic image galleries, contact forms, and a streamlined content management workflow. The project was deployed to production with Cloudflare integration and fully configured email services.','قمت بتصميم وتطوير تطبيق ويب مخصص بالكامل باستخدام Laravel وTailwind CSS، مع توفير تجربة مستخدم ثنائية اللغة، وتصميمات متجاوبة، ومعارض صور ديناميكية، ونماذج اتصال، ونظام إدارة محتوى مبسط. تم نشر المشروع في بيئة الإنتاج مع تكامل Cloudflare وخدمات بريد إلكتروني مُهيأة بالكامل.','The application follows Laravel''s MVC architecture, separating presentation, business logic, and data access to keep the codebase maintainable. Dynamic content is served from the backend while the frontend uses reusable components for a consistent user experience. Docker was used during development to provide a reproducible environment, and Cloudflare was configured for DNS management and performance.','','The project did not present significant technical obstacles, allowing me to focus on delivering a clean, polished, and reliable implementation. The primary objective was producing a high-quality solution that met the client''s requirements while maintaining good development practices.','','This project reinforced the importance of managing the complete software development lifecycle independently. Working directly from initial requirements through design, implementation, deployment, and production support strengthened my ability to deliver complete web solutions while balancing technical quality with business needs.','','Flow Egypt is a corporate website developed for a real estate company to showcase its services, strengthen its online presence, and provide an easy way for potential clients to explore the business and get in touch.','موقع Flow Egypt هو موقع إلكتروني مصمم خصيصًا لشركة عقارية لعرض خدماتها، وتعزيز حضورها الرقمي، وتوفير طريقة سهلة للعملاء المحتملين لاستكشاف أعمالها والتواصل معها.');
SET @pid = (SELECT id FROM projects WHERE slug='flow-egypt');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Laravel' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='SQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Git' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='VPS Deployment' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,company_en,company_ar,my_role_en,my_role_ar,duration_en,duration_ar,team_size,contribution_percentage,performance_score,user_count,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar,short_description_en,short_description_ar) VALUES ('KAS – Hosting Administration Panel','KAS – لوحة إدارة السرفرات','kas-hosting-administration-panel','2','1',NULL,'published','/assets/images/projects/kas-hosting-administration-panel.webp','/assets/images/projects/kas-hosting-administration-panel-hero.webp','ALL-INKL.com','ALL-INKL.com','Full Stack Web Developer','مطور ويب متكامل','19 Months','','8','25','98','4000','100','1','https://kas.all-inkl.com/','','KAS is ALL-INKL''s proprietary hosting administration platform, providing customers with a centralized interface to manage hosting services, domains, email accounts, databases, and other hosting resources.



As part of an international engineering team based in Dubai and Germany, I contributed to the development and modernization of the platform over approximately 18 months. My work included designing and implementing new user interfaces, developing reusable frontend architecture, building backend functionality with vanilla PHP, integrating internal APIs, and improving the overall usability and performance of the application.



Throughout the project, I developed reusable UI components including universal tables, pagination, tooltips, notification systems, password generation tools, language and theme switchers, advanced filtering and search functionality, responsive layouts, and a custom CSS utility framework. I also contributed to automation scripts, testing, production improvements, and performance optimization to support the continuous evolution of the platform.','KAS هي منصة إدارة الاستضافة الخاصة بشركة ALL-INKL، وتوفر للعملاء واجهة مركزية لإدارة خدمات الاستضافة، وإدارة النطاقات، والبريد الإلكتروني، وقواعد البيانات، وغيرها من خدمات الاستضافة.



على مدار ما يقارب عامًا ونصف، شاركت ضمن فريق هندسي دولي بين دبي وألمانيا في تطوير الجيل الجديد من المنصة. شمل عملي تصميم وتنفيذ واجهات مستخدم جديدة، وتطوير مكونات قابلة لإعادة الاستخدام، والمساهمة في تطوير الخلفية باستخدام PHP التقليدية، والتكامل مع واجهات برمجة التطبيقات الداخلية، بالإضافة إلى تحسين الأداء وتجربة المستخدم بشكل مستمر.



ساهمت في تطوير العديد من المكونات والميزات مثل الجداول القابلة لإعادة الاستخدام، ونظام الترقيم (Pagination)، وأدوات التلميحات (Tooltips)، ونظام الإشعارات، ومولد كلمات المرور، ومبدلات اللغة والثيم، وميزات البحث والتصفية، والتصميم المتجاوب، بالإضافة إلى تطوير إطار CSS داخلي لتوحيد واجهات المستخدم. كما شاركت في تطوير سكربتات الأتمتة، واختبار الميزات الجديدة، وتحسين الأداء، والمساهمة في استقرار المنصة أثناء تطورها المستمر.','As the platform continued to evolve, there was a need to modernize the user experience, improve interface consistency, introduce reusable frontend components, and streamline user workflows while maintaining compatibility with existing backend services and infrastructure.','مع تطور المنصة، ظهرت الحاجة إلى تحديث تجربة المستخدم، وتحسين اتساق الواجهات، وبناء مكونات قابلة لإعادة الاستخدام، وتبسيط سير العمل مع الحفاظ على التوافق مع خدمات البنية الخلفية الحالية.','Develop modern and reusable frontend components, improve dashboard usability, implement advanced interface features, integrate seamlessly with internal APIs, optimize performance, and build maintainable code that supports the continued evolution of the platform.','تطوير مكونات واجهة حديثة وقابلة لإعادة الاستخدام، وتحسين سهولة استخدام لوحة التحكم، وإضافة ميزات تفاعلية جديدة، وربطها مع واجهات برمجة التطبيقات الداخلية، وتحسين الأداء، مع الحفاظ على كود منظم وقابل للتطوير.','The application follows a server-rendered architecture built with vanilla PHP on the backend and vanilla JavaScript on the frontend. The frontend communicates with internal APIs provided by the engineering team in Germany, allowing new interface features to be developed while respecting organizational data access policies. The platform emphasizes reusable UI components, modular frontend architecture, and efficient interaction between the presentation layer and backend services.','يعتمد النظام على بنية تطبيق تعتمد على PHP التقليدية في الخلفية وJavaScript التقليدية في الواجهة الأمامية. تتواصل الواجهة مع واجهات برمجة تطبيقات داخلية تم تطويرها بواسطة الفريق الهندسي في ألمانيا، مما أتاح تطوير ميزات جديدة مع الالتزام بسياسات حماية البيانات. كما يعتمد النظام على مكونات واجهة قابلة لإعادة الاستخدام وبنية منظمة تسهل صيانة التطبيق وتطويره.','One of the key engineering considerations was collaborating across distributed teams while integrating with backend APIs maintained by another engineering group. Frontend development required designing reusable components that could efficiently interact with existing services, maintain consistent user experiences, and support the continuous evolution of a large production platform.','من أبرز التحديات التقنية العمل ضمن فرق هندسية موزعة والتكامل مع واجهات برمجة تطبيقات يتم تطويرها وصيانتها بواسطة فريق آخر. تطلب ذلك تصميم مكونات قابلة لإعادة الاستخدام، وضمان التكامل السلس مع الخدمات الحالية، والحفاظ على تجربة مستخدم متناسقة داخل منصة إنتاج كبيرة.','Working on a large production platform strengthened my experience in building maintainable frontend architecture, creating reusable UI systems, integrating APIs, optimizing application performance, and collaborating effectively within international engineering teams. It also reinforced the importance of writing scalable code that remains easy to maintain as products continue to evolve.','من خلال العمل على منصة إنتاج كبيرة، اكتسبت خبرة أعمق في بناء واجهات قابلة للصيانة، وتطوير مكونات قابلة لإعادة الاستخدام، والتكامل مع واجهات برمجة التطبيقات، وتحسين الأداء، والعمل ضمن فرق هندسية دولية. كما عزز المشروع أهمية كتابة كود منظم وقابل للتوسع مع تطور المنتجات على المدى الطويل.','KAS is ALL-INKL''s proprietary hosting administration platform, providing customers with a centralized interface to manage hosting services, domains, email accounts, databases, and other hosting resources.','KAS هي منصة إدارة الاستضافة الخاصة بشركة ALL-INKL، وتوفر للعملاء واجهة مركزية لإدارة خدمات الاستضافة، وإدارة النطاقات، والبريد الإلكتروني، وقواعد البيانات، وغيرها من خدمات الاستضافة.');
SET @pid = (SELECT id FROM projects WHERE slug='kas-hosting-administration-panel');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='SQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Linux' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Git' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Dashboard' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,company_en,company_ar,my_role_en,my_role_ar,duration_en,duration_ar,team_size,contribution_percentage,performance_score,user_count,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar,short_description_en,short_description_ar) VALUES ('MonyMonk','MonyMonk','monymonk','1','1','1','published','/assets/images/projects/monymonk.webp','/assets/images/projects/monymonk-hero.webp','MonyMonk','MonyMonk','Full product development','تطوير المنتج بالكامل','','','1','100','100','0','100','2','https://monymonk.com/','https://github.com/Oelsayed99/money_exchange_manager-','','','Currency-exchange businesses need to track money moving between themselves and clients across multiple currencies without incorrectly collapsing everything into a single base-currency balance.','تحتاج شركات صرف العملات إلى تتبع الأموال التي تنتقل بينها وبين العملاء عبر عملات متعددة دون دمج كل شيء بشكل خاطئ في رصيد عملة أساسية واحدة.','A bilingual financial ledger system for recording movements, currency exchanges, client balances, accounts, reconciliation, statements and audit history.','نظام دفتر حسابات مالي ثنائي اللغة لتسجيل الحركات، وتبادل العملات، وأرصدة العملاء، والحسابات، والتسويات، والبيانات، وسجل التدقيق.','','','','','','','Currency-exchange businesses need to track money moving between themselves and clients across multiple currencies without incorrectly collapsing everything into a single base-currency balance.','تحتاج شركات صرف العملات إلى تتبع الأموال التي تنتقل بينها وبين العملاء عبر عملات متعددة دون دمج كل شيء بشكل خاطئ في رصيد عملة أساسية واحدة.');
SET @pid = (SELECT id FROM projects WHERE slug='monymonk');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Laravel' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MongoDB' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Git' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='GitHub' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Cloudflare' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Dashboard' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,company_en,company_ar,my_role_en,my_role_ar,duration_en,duration_ar,team_size,contribution_percentage,performance_score,user_count,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar,short_description_en,short_description_ar) VALUES ('Super Speed','Super Speed','super-speed','3','1',NULL,'published','/assets/images/projects/super-speed.webp','/assets/images/projects/super-speed-hero.webp','Super Speed','Super Speed','Sole Full-Stack Developer & Designer','المطور والمصمم Full-Stack المسؤول عن المشروع بالكامل','','','1','100','95','0','100','3','https://dev.super-speed-service.com/','https://github.com/Oelsayed99/super-speed-security','Super Speed Security is a custom full-stack web application developed for a security and cash-in-transit services company.



I designed and developed the entire application from scratch using native PHP, MySQL, PDO, and vanilla JavaScript, following a lightweight MVC-inspired / Front Controller architecture.



A major part of the project is a custom visual content management system built directly into the website.



Instead of requiring administrators to open a traditional CMS dashboard, authorized users can browse the website normally and simply right-click on editable content.



Depending on the selected element, the CMS allows them to:



Edit text directly

Replace images

Replace videos

Update bilingual English and Arabic content

Manage visual assets without modifying source code

See their changes directly within the page they are editing



This creates a WYSIWYG-style editing experience where the website itself becomes the content-management interface.



The application also contains a dedicated admin and editor management system. Administrators can create additional users and give other team members access to edit website content without sharing a single administrator account.



The system combines database-driven content, multilingual support, secure authentication, media management, responsive design, RTL support, and asynchronous JavaScript communication with the PHP backend.



The result is not simply a corporate website, but a lightweight custom CMS platform tailored specifically to the client''s workflow.','Super Speed Security هو تطبيق ويب Full-Stack مخصص تم تطويره لشركة تعمل في مجال خدمات الأمن ونقل الأموال.



قمت بتصميم وتطوير التطبيق بالكامل من الصفر باستخدام PHP Native وMySQL وPDO وVanilla JavaScript مع بنية خفيفة مستوحاة من MVC وFront Controller.



أحد أهم أجزاء المشروع هو نظام إدارة محتوى مرئي تم دمجه مباشرة داخل الموقع.



بدلاً من إجبار المسؤول على الدخول إلى لوحة CMS تقليدية والبحث عن الصفحة أو العنصر الذي يريد تعديله، يمكن للمستخدم المصرح له تصفح الموقع بشكل طبيعي ثم الضغط بزر الفأرة الأيمن على المحتوى الذي يريد تعديله.



بحسب نوع العنصر، يستطيع المستخدم:



تعديل النصوص مباشرة

استبدال الصور

استبدال الفيديوهات

تعديل المحتوى العربي والإنجليزي

إدارة الوسائط بدون تعديل الكود

مشاهدة التعديل مباشرة داخل نفس الصفحة



بهذه الطريقة يصبح الموقع نفسه هو واجهة إدارة المحتوى، مما يوفر تجربة تعديل مرئية وبسيطة للمستخدمين غير التقنيين.



يحتوي التطبيق أيضاً على نظام لإدارة المسؤولين والمحررين يسمح للمسؤول بإضافة مستخدمين جدد ومنح أعضاء آخرين في الفريق صلاحية إدارة وتعديل محتوى الموقع دون مشاركة حساب إداري واحد.



يجمع النظام بين إدارة المحتوى من قاعدة البيانات، ودعم اللغات، ونظام Authentication، وإدارة الوسائط، والتصميم المتجاوب، ودعم RTL، والتواصل غير المتزامن بين JavaScript وPHP.



لذلك فالمشروع ليس مجرد موقع شركة، بل منصة CMS مخصصة تم تصميمها بالكامل لتناسب طريقة عمل العميل.','Super Speed needed more than a traditional static corporate website.



The company required a professional digital presence capable of presenting security, VIP protection, facility protection, event security, cash-in-transit, secure transportation, vault storage, and related services to both Arabic- and English-speaking customers.



The website also needed to remain maintainable after delivery.



The company needed the ability to change marketing copy, images, videos, client logos, and other content without modifying source code or contacting a developer for every update.



Another important constraint was deploying the application to the client''s existing hosting infrastructure without introducing unnecessary framework complexity or server requirements.','كانت شركة Super Speed بحاجة إلى أكثر من مجرد موقع تعريفي ثابت.



احتاجت الشركة إلى منصة احترافية لعرض خدمات الأمن وحماية الشخصيات والمنشآت والفعاليات ونقل الأموال والنقل الآمن والتخزين والخدمات المرتبطة بها للعملاء الناطقين باللغة العربية والإنجليزية.



كما كان من الضروري أن تتمكن الشركة من إدارة الموقع بعد تسليمه.



كان العميل بحاجة إلى تعديل النصوص والصور والفيديوهات وشعارات العملاء والمحتوى التسويقي دون تعديل الكود أو الاعتماد على المطور في كل تحديث.



بالإضافة إلى ذلك، كان يجب أن يعمل النظام على بيئة الاستضافة الحالية الخاصة بالعميل دون إضافة تعقيدات أو متطلبات غير ضرورية ناتجة عن استخدام Framework كبير.','I developed a custom CMS rather than integrating WordPress or another third-party content-management platform.



The central idea was to remove the separation between the website and its administration interface.



When an authenticated editor visits the website, editable elements become manageable directly within their normal page context.



A right-click interaction identifies the selected CMS element and opens the appropriate editing controls.



For example:



Text



Right-clicking editable text allows the editor to change its content.



Images



Right-clicking an editable image allows it to be replaced with another image.



Videos



Editable video content can similarly be replaced without touching the underlying source code.



JavaScript handles the interactive editing experience and communicates with PHP endpoints asynchronously. PHP validates the request, processes the content or uploaded media, and persists the changes in MySQL or managed storage.



Because the content is database-driven, the same CMS architecture also supports both English and Arabic.



A separate administration system manages authorized users, allowing administrators to add additional editors who can maintain the website.



This gives the client control of their website while keeping the underlying application lightweight and custom-built.','بدلاً من استخدام WordPress أو CMS جاهز، قمت ببناء نظام إدارة محتوى مخصص بالكامل داخل التطبيق.



كانت الفكرة الأساسية هي إزالة الفصل التقليدي بين الموقع ولوحة الإدارة.



عندما يقوم المستخدم المصرح له بتسجيل الدخول وتصفح الموقع، يمكنه إدارة العناصر مباشرة داخل الصفحة التي يشاهدها.



يتم استخدام Right Click على العنصر المطلوب لتحديده وفتح أدوات التعديل المناسبة.



النصوص



يمكن الضغط بزر الفأرة الأيمن على النص وتعديل المحتوى مباشرة.



الصور



يمكن الضغط على الصورة واستبدالها بصورة جديدة.



الفيديوهات



يمكن استبدال ملفات الفيديو بالطريقة نفسها دون الحاجة إلى تعديل الكود.



يتولى JavaScript تجربة التعديل داخل الواجهة والتواصل مع PHP بشكل غير متزامن.



يقوم Backend بعد ذلك بالتحقق من الطلب ومعالجة المحتوى أو الملفات وحفظ التغييرات داخل MySQL أو نظام تخزين الوسائط.



وبما أن المحتوى يعتمد على قاعدة البيانات، فإن نفس النظام يدعم المحتوى باللغتين العربية والإنجليزية.



كما يحتوي التطبيق على نظام منفصل لإدارة المستخدمين يسمح للمسؤول بإضافة محررين آخرين ومنحهم إمكانية إدارة محتوى الموقع.','Public / Presentation Layer



PHP views render the normal bilingual website.



CMS Interaction Layer



Vanilla JavaScript detects editable elements and handles:



Right-click/context-menu events

Element identification

Text editing

Image replacement

Video replacement

Fetch API requests

Updating the rendered page after successful changes

PHP Application Layer



PHP endpoints receive CMS requests and perform:



Authentication checks

Request validation

Content updates

File processing

Database operations

Media replacement

Data Layer



MySQL stores database-driven content and application information using PDO.



Media Layer



Uploaded images and videos are validated, stored and associated with the correct content entries.



Administration Layer



Authenticated administration functionality manages users who are permitted to access the CMS and edit website content.','طبقة العرض/الواجهة العامة



تقوم واجهات PHP بعرض الموقع الإلكتروني ثنائي اللغة بشكل طبيعي.



طبقة التفاعل مع نظام إدارة المحتوى (CMS)



تكتشف جافا سكريبت العناصر القابلة للتعديل وتتعامل معها:



أحداث النقر بزر الماوس الأيمن/قائمة السياق

تحديد العنصر

تحرير النصوص

استبدال الصور

استبدال مقاطع الفيديو

جلب طلبات واجهة برمجة التطبيقات (API)

تحديث الصفحة المعروضة بعد إتمام التغييرات بنجاح.

طبقة تطبيق PHP



تستقبل نقاط نهاية PHP طلبات نظام إدارة المحتوى (CMS) وتنفذ ما يلي:



التحقق من المصادقة

التحقق من صحة الطلب

تحديثات المحتوى

معالجة الملفات

عمليات قاعدة البيانات

استبدال الوسائط.

طبقة البيانات



يخزن MySQL المحتوى المُستمد من قاعدة البيانات ومعلومات التطبيق باستخدام PDO.



طبقة الوسائط



يتم التحقق من صحة الصور ومقاطع الفيديو المُحمّلة، وتخزينها، وربطها بإدخالات المحتوى الصحيحة.



طبقة الإدارة



تدير وظائف الإدارة المُصادق عليها المستخدمين المصرح لهم بالوصول إلى نظام إدارة المحتوى (CMS) وتعديل محتوى الموقع الإلكتروني.','Building context-aware editing



One of the main technical challenges was connecting visual elements rendered on the frontend to their corresponding stored content.



The CMS needed to identify exactly which text, image, or video the administrator selected and map that element to the correct stored content.



JavaScript handles the context-menu interaction and identifies the editable element, while the PHP backend processes and persists the requested change.



Supporting different content types



Text updates and media replacements require different workflows.



The CMS therefore needed to distinguish between content types and provide the correct editing experience and backend processing for each one.



Maintaining the editing experience across languages



Because the website supports both English and Arabic, the CMS also had to associate edits with the correct language version while preserving the same page architecture.



Designing editing for non-technical users



The biggest UX goal was removing the need for administrators to understand a CMS hierarchy.



Instead of:



Dashboard → Pages → Find Page → Find Section → Find Field → Edit



the workflow becomes:



Open Page → Find Content → Right Click → Edit','بناء نظام تحرير مُراعي للسياق



كان أحد التحديات التقنية الرئيسية هو ربط العناصر المرئية المعروضة في واجهة المستخدم بالمحتوى المُخزّن المُناسب لها.



كان على نظام إدارة المحتوى (CMS) تحديد النص أو الصورة أو الفيديو الذي اختاره المسؤول بدقة، وربط هذا العنصر بالمحتوى المُخزّن الصحيح.



تتولى لغة جافا سكريبت التفاعل مع قائمة السياق وتحديد العنصر القابل للتحرير، بينما يقوم نظام PHP في الواجهة الخلفية بمعالجة التغيير المطلوب وحفظه.



دعم أنواع المحتوى المختلفة



تتطلب تحديثات النصوص واستبدال الوسائط سير عمل مختلفًا.



لذا، كان على نظام إدارة المحتوى التمييز بين أنواع المحتوى وتوفير تجربة التحرير المناسبة ومعالجة الواجهة الخلفية لكل نوع.



الحفاظ على تجربة التحرير عبر اللغات



نظرًا لأن الموقع يدعم اللغتين الإنجليزية والعربية، كان على نظام إدارة المحتوى أيضًا ربط التعديلات بنسخة اللغة الصحيحة مع الحفاظ على بنية الصفحة نفسها.



تصميم نظام تحرير سهل الاستخدام للمستخدمين غير التقنيين



كان الهدف الأهم في تجربة المستخدم هو تبسيط فهم المسؤولين لهيكل نظام إدارة المحتوى.



بدلاً من:



لوحة التحكم ← الصفحات ← البحث عن صفحة ← البحث عن قسم ← البحث عن حقل ← تحرير



يصبح سير العمل كالتالي:



فتح الصفحة ← البحث عن محتوى ← النقر بزر الماوس الأيمن ← تحرير','This project reinforced the importance of selecting architecture based on the actual problem rather than automatically choosing the largest available framework.



A structured native PHP application can remain clean and maintainable when responsibilities such as persistence, content retrieval, media storage, routing, and presentation are intentionally separated.



I also gained deeper experience designing editable multilingual applications where content should be treated as structured application data rather than static text embedded inside templates.



Building the inline CMS highlighted the value of designing administration tools around the user''s workflow. Allowing a client to edit the actual page they are viewing can provide a significantly simpler experience than requiring them to understand a traditional CMS dashboard.



The project also strengthened my experience with secure file handling, authentication, PDO, asynchronous JavaScript communication, RTL interfaces, environment-aware development, and deploying custom PHP applications to traditional hosting infrastructure.','أكد لي هذا المشروع أهمية اختيار بنية التطبيق بناءً على المشكلة الفعلية بدلاً من استخدام أكبر Framework متاح بشكل تلقائي.



يمكن لتطبيق مبني باستخدام PHP Native أن يكون منظماً وسهل الصيانة إذا تم فصل المسؤوليات مثل قاعدة البيانات والمحتوى والوسائط والـ Routing وعرض الصفحات بشكل صحيح.



كما اكتسبت خبرة أكبر في تصميم تطبيقات متعددة اللغات يكون فيها المحتوى جزءاً من بيانات النظام وليس مجرد نص ثابت داخل صفحات HTML.



ساعدني تطوير Inline CMS أيضاً على فهم أهمية تصميم أدوات الإدارة بناءً على طريقة استخدام العميل الفعلية. السماح للعميل بتعديل الصفحة التي يشاهدها مباشرة يوفر تجربة أبسط بكثير من إجباره على تعلم لوحة CMS تقليدية.



كما عزز المشروع خبرتي في إدارة الملفات بشكل آمن، Authentication، PDO، الاتصال غير المتزامن باستخدام JavaScript، دعم RTL، بيئات التطوير المختلفة، ونشر تطبيقات PHP مخصصة على الاستضافات التقليدية.','Super Speed Security is a custom full-stack web application developed for a security and cash-in-transit services company.','Super Speed Security هو تطبيق ويب Full-Stack مخصص تم تطويره لشركة تعمل في مجال خدمات الأمن ونقل الأموال.');
SET @pid = (SELECT id FROM projects WHERE slug='super-speed');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='SQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Git' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='GitHub' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Cloudflare' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,company_en,company_ar,my_role_en,my_role_ar,duration_en,duration_ar,team_size,contribution_percentage,performance_score,user_count,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar,short_description_en,short_description_ar) VALUES ('YaxiGo – International Travel Booking Platform','YaxiGo – منصة حجز السفر الدولي','yaxigo-international-travel-booking-platform','5','2',NULL,'published','/assets/images/projects/yaxigo-international-travel-booking-platform.webp','/assets/images/projects/yaxigo-international-travel-booking-platform-hero.webp','YaxiGo','YaxiGo','Full Stack Developer & UI/UX Designer','مطور برامج متكامل و مصمم واجهات','','','1','100','95','500','100','4','https://yaxigo.elsayedomar.com/','','YaxiGo is a full-stack travel booking platform currently under active development. The project is designed around clean architecture principles to support multiple transportation providers, payment gateways, and future expansion into additional travel services.



The application focuses on maintainability, scalability, localization, and security from the start. Instead of tightly coupling business logic to a single provider, the system uses abstraction layers that allow providers and payment gateways to be added or replaced with minimal changes.



The platform includes multilingual support (English and Arabic), RTL compatibility, customer authentication, booking management, role-based permissions, audit logging, and an administration panel for managing operations. The infrastructure is designed to support production deployment and long-term growth.','YaxiGo هي منصة متكاملة لحجز الرحلات قيد التطوير، تم تصميمها باستخدام مبادئ الهندسة البرمجية الحديثة لضمان القابلية للتوسع وسهولة الصيانة.



تعتمد المنصة على بنية مرنة تسمح بإضافة مزودي خدمات النقل وبوابات الدفع بسهولة دون الحاجة إلى إعادة بناء النظام. كما تدعم اللغتين العربية والإنجليزية، واتجاه RTL، وإدارة المستخدمين، وتتبع الحجوزات، والصلاحيات، وسجل العمليات، ولوحة تحكم إدارية.','Many travel booking systems are tightly coupled to a single provider, making future integrations expensive and difficult. They also lack proper localization, scalable architecture, and administrative tools required for international operations.','تعتمد العديد من منصات الحجز على مزود خدمة واحد، مما يجعل التوسع أو إضافة مزودين جدد عملية معقدة ومكلفة، بالإضافة إلى ضعف دعم تعدد اللغات والإدارة.','Design a modular booking platform using Laravel with provider abstraction, payment gateway abstraction, multilingual support, and a scalable domain-driven architecture capable of supporting future transportation services.','بناء منصة مرنة تعتمد على Laravel مع طبقات تجريد لمزودي الخدمات وبوابات الدفع، ودعم كامل لتعدد اللغات، وبنية قابلة للتوسع لاستيعاب خدمات إضافية مستقبلاً.','The application follows a layered architecture separating presentation, business logic, domain services, and infrastructure. Provider integrations and payment gateways are implemented using interfaces and interchangeable adapters, reducing coupling and improving maintainability. Localization, authorization, and notifications are implemented as independent modules to encourage scalability.','يعتمد النظام على معمارية متعددة الطبقات تفصل بين واجهة المستخدم ومنطق الأعمال والبنية التحتية. كما يتم تنفيذ تكاملات مزودي الخدمات وبوابات الدفع باستخدام واجهات مجردة (Interfaces) لتسهيل التوسع والصيانة.','Designing provider-agnostic booking workflows

Building scalable booking state management

Supporting Arabic RTL and English localization

Structuring a maintainable Laravel architecture

Managing complex booking relationships

Creating extensible payment integrations

Production deployment using OpenLiteSpeed

Performance optimization and caching strategy','تصميم نظام مستقل عن مزود الخدمة

إدارة حالات الحجز

دعم العربية والإنجليزية

بناء هيكل Laravel قابل للتوسع

إدارة العلاقات المعقدة داخل قاعدة البيانات

تصميم تكاملات الدفع

النشر باستخدام OpenLiteSpeed

تحسين الأداء','Developing YaxiGo reinforced the importance of designing software around long-term maintainability rather than short-term implementation. The project improved my understanding of system architecture, domain modeling, deployment automation, localization, and scalable backend design while balancing current business needs with future expansion.','ساهم المشروع في تعميق فهمي لتصميم الأنظمة القابلة للتوسع، ونمذجة الأعمال، وإدارة عمليات النشر، ودعم تعدد اللغات، وأهمية بناء حلول مرنة يمكن تطويرها مستقبلاً دون الحاجة إلى إعادة هيكلة النظام.','YaxiGo is a full-stack travel booking platform currently under active development. The project is designed around clean architecture principles to support multiple transportation providers, payment gateways, and future expansion into additional travel services.','YaxiGo هي منصة متكاملة لحجز الرحلات قيد التطوير، تم تصميمها باستخدام مبادئ الهندسة البرمجية الحديثة لضمان القابلية للتوسع وسهولة الصيانة.');
SET @pid = (SELECT id FROM projects WHERE slug='yaxigo-international-travel-booking-platform');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Laravel' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='SQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Git' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='GitHub' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('PitchProof','بيتش بروف','pitchproof','1','1','2','published','/assets/images/projects/pitchproof.webp','/assets/images/projects/pitchproof-hero.webp','AI-assisted PR briefing tool that refuses to treat model output as truth.','أداة ذكاء اصطناعي لتجهيز البيانات الصحفية ترفض اعتبار مخرجات النموذج حقيقة.','Sole developer','مطور منفرد','','','2026','2026','1','100','0','0','100','100','','https://github.com/Oelsayed99/pitchproof','PitchProof guides a PR consultant through a structured six-step brief for a product launch or funding announcement, checks every answer for meaning and evidence, exposes the claims that could be repeated publicly, requires human approval, and generates pitches from approved facts only.','يرشد بيتش بروف مستشار العلاقات العامة عبر نموذج من ست خطوات لإطلاق منتج أو إعلان تمويل، ويراجع كل إجابة من حيث المعنى والدليل، ويعرض الادعاءات القابلة للنشر، ويشترط موافقة بشرية، ثم يولّد العروض من الحقائق المعتمدة فقط.','Generic AI writing tools turn a thin announcement into fluent but unsupported copy. For PR, a confident sentence that isn''t true is worse than no sentence.','تحوّل أدوات الكتابة بالذكاء الاصطناعي الإعلانات الضعيفة إلى نصوص سلسة لكن بلا سند. وفي العلاقات العامة، الجملة الواثقة غير الصحيحة أسوأ من عدم وجودها.','Deterministic preflight rules check completeness, Gemini reviews every answer and extracts a claim inventory, a human approves, edits or rejects each claim, and three story angles and pitches are generated from approved claim IDs only.','قواعد فحص مسبقة تتحقق من الاكتمال، ثم يراجع Gemini كل إجابة ويستخرج قائمة الادعاءات، ويوافق شخص على كل ادعاء أو يعدّله أو يرفضه، ثم تُولَّد ثلاث زوايا وعروض من معرّفات الادعاءات المعتمدة فقط.','Next-compatible TypeScript app with server-side API routes for review and generation; API keys never reach the browser. Zod validates every model response, and a deterministic demo mode gives reliable presentations without calling the model.','تطبيق TypeScript بمسارات API على الخادم للمراجعة والتوليد، ولا تصل مفاتيح API إلى المتصفح. يتحقق Zod من كل استجابة للنموذج، ويوفر وضع العرض الثابت عروضًا موثوقة دون استدعاء النموذج.','Enforcing grounding in code rather than in the prompt: every generated sentence must reference an approved claim ID, and a single unknown or rejected reference rejects the whole response. Provider failures reveal no partial output.','فرض الالتزام بالمصادر في الكود لا في التعليمات: كل جملة مولدة يجب أن تشير إلى معرّف ادعاء معتمد، وأي إشارة غير معروفة أو مرفوضة ترفض الاستجابة كاملة. ولا تُعرض أي مخرجات جزئية عند فشل المزود.','Model output is untrusted input. Treating it with the same validation as user input, and making the verification boundary visible to the user, is what makes an AI tool safe to rely on.','مخرجات النموذج مدخلات غير موثوقة. التعامل معها بنفس التحقق المطبق على مدخلات المستخدم، وجعل حدود التحقق واضحة له، هو ما يجعل أداة الذكاء الاصطناعي جديرة بالاعتماد.');
SET @pid = (SELECT id FROM projects WHERE slug='pitchproof');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='TypeScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='React' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Next.js' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Tailwind CSS' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Zod' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Gemini API' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Vitest' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='AI' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('SeroEvents Platform','منصة SeroEvents','seroevents-platform','1','2','3','published','/assets/images/projects/seroevents-platform.webp','/assets/images/projects/seroevents-platform-hero.webp','Bilingual website and event platform for healthcare and scientific conferences in the UAE.','موقع ومنصة فعاليات ثنائية اللغة للمؤتمرات الطبية والعلمية في الإمارات.','Tech Lead','قائد تقني','SeroEvents UAE','SeroEvents الإمارات','2026 – present','2026 – الآن','1','100','0','0','60','101','https://seroevents.com','','As Tech Lead at SeroEvents UAE I''m rebuilding the company''s website into an event platform: bilingual English and Arabic, with the public event catalogue migrated from the original site.','بصفتي القائد التقني في SeroEvents الإمارات، أعيد بناء موقع الشركة ليصبح منصة فعاليات ثنائية اللغة بالعربية والإنجليزية، مع نقل كتالوج الفعاليات العامة من الموقع السابق.','','','','','Next.js 15 (App Router) with PostgreSQL through Prisma, Microsoft Graph for transactional email, and file storage kept alongside the database for backups. Runs behind a reverse proxy in production.','Next.js 15 مع PostgreSQL عبر Prisma، وMicrosoft Graph للبريد الإلكتروني، وتخزين الملفات بجانب قاعدة البيانات للنسخ الاحتياطي، ويعمل خلف Reverse Proxy في الإنتاج.','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='seroevents-platform');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Next.js' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='TypeScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PostgreSQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Prisma' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('In-App Translation System','نظام الترجمة داخل التطبيق','kas-translation-system','2','1',NULL,'published','/assets/images/projects/kas-translation-system.webp','/assets/images/projects/kas-translation-system-hero.webp','Translate a hosting platform in place: inline editing, msgid storage, translation states and history.','ترجمة منصة استضافة في مكانها: تحرير مباشر وتخزين بالمعرفات وحالات الترجمة وسجلها.','Architecture, frontend and backend endpoints','المعمارية والواجهة ونقاط الخادم','ALL-INKL.COM','ALL-INKL.COM','2024 – 2026','2024 – 2026','1','100','0','0','100','102','','','Tooling that lets translators work directly inside the ALL-INKL platform instead of editing code: iframe-based inline editing, msgid storage, per-string states (new, ongoing, done, checked), attribute translation, per-page status, history and comments.','أداة تتيح للمترجمين العمل داخل منصة ALL-INKL مباشرة دون تعديل الكود: تحرير داخل iframe، وتخزين بالمعرفات، وحالات لكل نص (جديد، قيد العمل، منجز، تمت مراجعته)، وترجمة السمات، وحالة لكل صفحة، وسجل وتعليقات.','Platform content had to be translated and maintained across languages, and translators needed context without touching source code.','كان لا بد من ترجمة محتوى المنصة وصيانته بعدة لغات، واحتاج المترجمون إلى السياق دون لمس الكود.','','','','','Cross-origin constraints between the editor and the framed pages, translating attributes such as title, tooltip and placeholder, and accessibility issues like aria-hidden warnings.','قيود المصادر المختلفة بين المحرر والصفحات المضمنة، وترجمة السمات مثل العنوان والتلميح والنص المؤقت، ومشكلات الوصولية مثل تحذيرات aria-hidden.','','');
SET @pid = (SELECT id FROM projects WHERE slug='kas-translation-system');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Dashboard' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Browser CCTV Viewer','عارض كاميرات المراقبة','cctv-browser-viewer','2','1',NULL,'published','/assets/images/projects/cctv-browser-viewer.webp','/assets/images/projects/cctv-browser-viewer-hero.webp','Live and recorded RTSP camera feeds across offices, viewable in an ordinary browser.','بث مباشر ومسجل لكاميرات RTSP في المكاتب عبر متصفح عادي.','Browser interface and integration','واجهة المتصفح والتكامل','ALL-INKL.COM','ALL-INKL.COM','2025','2025','1','100','0','0','100','103','','','A browser interface over an RTSPtoWeb streaming service: single, 1×2, 2×2 and 3×3 camera matrices, live view, playback with a seek bar, office tabs and camera mapping, with JWT-protected access.','واجهة متصفح فوق خدمة بث RTSPtoWeb: شبكات عرض للكاميرات بأحجام مختلفة، وعرض مباشر، وتشغيل مع شريط تقديم، وتبويبات للمكاتب، وربط للكاميرات، مع وصول محمي بـ JWT.','','','','','','','RTSP port conflicts, limits on concurrent streams, and Safari-specific playback failures over MSE/WebSocket.','تعارض منافذ RTSP، وحدود البث المتزامن، ومشكلات تشغيل خاصة بمتصفح Safari عبر MSE وWebSocket.','','');
SET @pid = (SELECT id FROM projects WHERE slug='cctv-browser-viewer');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Linux' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Dashboard' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Internal Business Tools','أدوات العمل الداخلية','kas-internal-tools','2','1',NULL,'published','/assets/images/projects/kas-internal-tools.webp','/assets/images/projects/kas-internal-tools-hero.webp','Charts across multiple databases with automatic numeric-field detection, CSV/Excel export and admin access control.','رسوم بيانية عبر قواعد بيانات متعددة مع اكتشاف الحقول الرقمية وتصدير CSV وExcel وصلاحيات إدارية.','Backend and frontend','الخادم والواجهة','ALL-INKL.COM','ALL-INKL.COM','2024 – 2025','2024 – 2025','1','100','0','0','100','104','','','Internal tools used day to day by the team: dynamic data visualization spanning multiple databases with month and session filtering, a lunch ordering system with per-person splitting, onboarding and data-entry forms, and GoJS mind maps saved by database ID.','أدوات داخلية يستخدمها الفريق يوميًا: عرض بيانات ديناميكي عبر قواعد بيانات متعددة مع تصفية بالشهر والجلسة، ونظام طلب غداء مع تقسيم لكل شخص، ونماذج تسجيل وإدخال بيانات، وخرائط ذهنية بـ GoJS.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='kas-internal-tools');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Dashboard' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Lead Generation Agent','وكيل توليد العملاء','n8n-lead-agent','5','2',NULL,'published','/assets/images/projects/n8n-lead-agent.webp','/assets/images/projects/n8n-lead-agent-hero.webp','Multi-workflow automation on self-hosted n8n that finds leads. Outreach and content generation are next.','أتمتة متعددة المسارات على n8n مستضاف ذاتيًا تبحث عن العملاء المحتملين. التواصل وإنشاء المحتوى هما الخطوة التالية.','Sole developer','مطور منفرد','','','2026 – present','2026 – الآن','1','100','0','0','40','105','','','Multi-workflow automation on self-hosted n8n that finds leads. Outreach and content generation are next.','أتمتة متعددة المسارات على n8n مستضاف ذاتيًا تبحث عن العملاء المحتملين. التواصل وإنشاء المحتوى هما الخطوة التالية.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='n8n-lead-agent');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='n8n' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Cloudflare' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='AI' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Automation' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('This Portfolio & CMS','هذا الموقع ونظام إدارته','portfolio-cms','4','2',NULL,'published','/assets/images/projects/portfolio-cms.webp','/assets/images/projects/portfolio-cms-hero.webp','A hand-written PHP MVC framework with a bilingual, database-backed CMS and inline editing.','إطار MVC مكتوب يدويًا بلغة PHP مع نظام إدارة محتوى ثنائي اللغة وتحرير مباشر.','Design and development','التصميم والتطوير','','','2025 – present','2025 – الآن','1','100','0','0','85','106','https://elsayedomar.com','https://github.com/Oelsayed99/portfolio-update','Router, controllers, models and views written from scratch. Case studies are composed from ordered sections with many-to-many technology and tag relationships, and all copy lives in the database so it can change without a deploy. Dockerised, with separate development and production stacks.','الموجّه والمتحكمات والنماذج والواجهات مكتوبة من الصفر. تتكون دراسات الحالة من أقسام مرتبة مع علاقات بالتقنيات والوسوم، وكل النصوص في قاعدة البيانات لتتغير دون نشر جديد. يعمل في Docker مع بيئتين للتطوير والإنتاج.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='portfolio-cms');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('PHP Auth & Admin System','نظام مصادقة وإدارة بـ PHP','php-auth-admin-system','4','1',NULL,'published','/assets/images/projects/php-auth-admin-system.webp','/assets/images/projects/php-auth-admin-system-hero.webp','A mini framework in pure PHP: routing, middleware, session auth, role-based access and an admin dashboard.','إطار مصغر بلغة PHP خالصة: توجيه ووسيط ومصادقة بالجلسات وصلاحيات حسب الدور ولوحة إدارة.','Personal project','مشروع شخصي','','','2026','2026','1','100','0','0','100','107','','https://github.com/Oelsayed99/php-auth-admin-system','Built to understand what frameworks do internally: a custom router, Auth and Admin middleware, request/response abstraction, an autoloader, a rule-based validator, global exception handling with clean JSON errors, and a plain-JavaScript admin dashboard for managing users and roles. Dockerised with MySQL and phpMyAdmin.','بُني لفهم ما تفعله الأطر داخليًا: موجّه مخصص، ووسيط للمصادقة والإدارة، وتجريد للطلب والاستجابة، ومحمّل تلقائي، ومدقق بالقواعد، ومعالجة عامة للأخطاء بردود JSON، ولوحة إدارة بـ JavaScript لإدارة المستخدمين والأدوار.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='php-auth-admin-system');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='MySQL' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Dashboard' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Rock, Paper, Scissors','حجر ورقة مقص','rock-paper-scissors','4','1',NULL,'published','/assets/images/projects/rock-paper-scissors.webp','/assets/images/projects/rock-paper-scissors-hero.webp','My first game: first to three points wins, in plain HTML, CSS and JavaScript.','أول لعبة لي: من يصل إلى ثلاث نقاط أولًا يفوز، بـ HTML وCSS وJavaScript فقط.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','108','https://r-p-s-game-5ca87a19c30b.herokuapp.com','https://github.com/Oelsayed99/rock-paper-scissors','My first game: first to three points wins, in plain HTML, CSS and JavaScript.','أول لعبة لي: من يصل إلى ثلاث نقاط أولًا يفوز، بـ HTML وCSS وJavaScript فقط.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='rock-paper-scissors');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Flask To-Do App','تطبيق مهام Flask','flask-todo-app','4','1',NULL,'published','/assets/images/projects/flask-todo-app.webp','/assets/images/projects/flask-todo-app-hero.webp','A CRUD task manager in Flask and SQLite, deployed on Heroku.','مدير مهام بعمليات CRUD باستخدام Flask وSQLite، منشور على Heroku.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','109','https://flaskcrudapptodolist-a663f04498c2.herokuapp.com/','https://github.com/Oelsayed99/flask-todo-app','A CRUD task manager in Flask and SQLite, deployed on Heroku.','مدير مهام بعمليات CRUD باستخدام Flask وSQLite، منشور على Heroku.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='flask-todo-app');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Python' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Flask' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='SQLite' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Portfolio v1 (Laravel)','الموقع الشخصي الإصدار الأول','laravel-portfolio-v1','3','5',NULL,'published','/assets/images/projects/laravel-portfolio-v1.webp','/assets/images/projects/laravel-portfolio-v1-hero.webp','My earlier Laravel portfolio, deployed automatically through GitHub Actions.','موقعي الشخصي السابق بـ Laravel، يُنشر تلقائيًا عبر GitHub Actions.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','110','','','My earlier Laravel portfolio, deployed automatically through GitHub Actions.','موقعي الشخصي السابق بـ Laravel، يُنشر تلقائيًا عبر GitHub Actions.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='laravel-portfolio-v1');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Laravel' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='GitHub' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Medium Clone','نسخة من Medium','laravel-medium-clone','3','5',NULL,'published','/assets/images/projects/laravel-medium-clone.webp','/assets/images/projects/laravel-medium-clone-hero.webp','A simple Laravel publishing app modelled on Medium.','تطبيق نشر بسيط بـ Laravel على غرار Medium.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','111','','https://github.com/Oelsayed99/Laravel-Medium-Clone','A simple Laravel publishing app modelled on Medium.','تطبيق نشر بسيط بـ Laravel على غرار Medium.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='laravel-medium-clone');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Laravel' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='PHP' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Web App' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('FastAPI Social Media API','واجهة تواصل اجتماعي FastAPI','fastapi-social-api','6','5',NULL,'published','/assets/images/projects/fastapi-social-api.webp','/assets/images/projects/fastapi-social-api-hero.webp','A social media REST API built while learning FastAPI.','واجهة REST لشبكة اجتماعية بنيتها أثناء تعلم FastAPI.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','112','','https://github.com/Oelsayed99/fastapi-socialmedia-app','A social media REST API built while learning FastAPI.','واجهة REST لشبكة اجتماعية بنيتها أثناء تعلم FastAPI.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='fastapi-social-api');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Python' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='FastAPI' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Mobile API' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Fruit Disease Detection (CNN)','اكتشاف أمراض الفاكهة بالشبكات العصبية','fruit-disease-detection','6','1',NULL,'published','/assets/images/projects/fruit-disease-detection.webp','/assets/images/projects/fruit-disease-detection-hero.webp','Research internship at VIT India comparing VGG16, VGG19, InceptionV3 and Xception on Indian fruit-disease images.','تدريب بحثي في معهد فيلور بالهند لمقارنة نماذج VGG16 وVGG19 وInceptionV3 وXception على صور أمراض الفاكهة.','Research intern','متدرب بحثي','Vellore Institute of Technology','معهد فيلور للتكنولوجيا','Oct – Dec 2022','أكتوبر – ديسمبر 2022','1','100','0','0','100','113','','https://github.com/Oelsayed99/Machine-Deep-learning','Transfer-learning study on apple, banana, guava and mixed Indian-fruit disease datasets, processed separately and together. Models were compared with accuracy and loss curves, confusion matrices, precision, recall and F1. In the reported runs VGG16 reached 98.5%, VGG19 99.0% and Xception 99.9% accuracy.','دراسة تعلّم نقل على بيانات أمراض التفاح والموز والجوافة ومجموعة فواكه هندية مختلطة، عولجت منفصلة ومجتمعة. قورنت النماذج بمنحنيات الدقة والخسارة ومصفوفات الالتباس والدقة والاستدعاء وF1. وحققت VGG16 دقة 98.5% وVGG19 دقة 99.0% وXception دقة 99.9%.','Early, accurate detection of fruit disease helps farmers and exporters act before a crop is lost.','الاكتشاف المبكر والدقيق لأمراض الفاكهة يساعد المزارعين والمصدرين على التصرف قبل خسارة المحصول.','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='fruit-disease-detection');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Python' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='TensorFlow' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Jupyter' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='AI' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('No-Show Medical Appointments','تحليل التغيب عن المواعيد الطبية','no-show-appointments','6','1',NULL,'published','/assets/images/projects/no-show-appointments.webp','/assets/images/projects/no-show-appointments-hero.webp','What predicts whether a patient shows up? An analysis of 100,000+ Brazilian medical appointments.','ما الذي يتنبأ بحضور المريض؟ تحليل لأكثر من 100 ألف موعد طبي في البرازيل.','Personal project','مشروع شخصي','','','2022','2022','1','100','0','0','100','114','','https://github.com/Oelsayed99/no-show-medical-appointments','What predicts whether a patient shows up? An analysis of 100,000+ Brazilian medical appointments.','ما الذي يتنبأ بحضور المريض؟ تحليل لأكثر من 100 ألف موعد طبي في البرازيل.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='no-show-appointments');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Python' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='pandas' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Jupyter' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Data Analysis' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Bike Share Data Analysis','تحليل بيانات مشاركة الدراجات','bike-share-analysis','6','1',NULL,'published','/assets/images/projects/bike-share-analysis.webp','/assets/images/projects/bike-share-analysis-hero.webp','Answering questions about bike-share usage with Python, from the Udacity Data Analysis Nanodegree.','الإجابة عن أسئلة حول استخدام مشاركة الدراجات بـ Python ضمن برنامج Udacity لتحليل البيانات.','Personal project','مشروع شخصي','','','2022','2022','1','100','0','0','100','115','','https://github.com/Oelsayed99/Bike-Share-Data-answering-questions-by-python-project','Answering questions about bike-share usage with Python, from the Udacity Data Analysis Nanodegree.','الإجابة عن أسئلة حول استخدام مشاركة الدراجات بـ Python ضمن برنامج Udacity لتحليل البيانات.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='bike-share-analysis');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Python' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='pandas' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Data Analysis' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('JavaScript Algorithms & Mini Apps','خوارزميات وتطبيقات JavaScript','javascript-fundamentals','6','1',NULL,'published','/assets/images/projects/javascript-fundamentals.webp','/assets/images/projects/javascript-fundamentals-hero.webp','Small vanilla JavaScript apps, including a palindrome checker and the Dragon Repeller RPG.','تطبيقات صغيرة بـ JavaScript، منها فاحص الكلمات المتناظرة ولعبة Dragon Repeller.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','116','','https://github.com/Oelsayed99/JavaScript-Algorithms-and-Data-Structures','Small vanilla JavaScript apps, including a palindrome checker and the Dragon Repeller RPG.','تطبيقات صغيرة بـ JavaScript، منها فاحص الكلمات المتناظرة ولعبة Dragon Repeller.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='javascript-fundamentals');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='JavaScript' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Responsive Web Design Projects','مشاريع التصميم المتجاوب','responsive-web-design','6','1',NULL,'published','/assets/images/projects/responsive-web-design.webp','/assets/images/projects/responsive-web-design-hero.webp','freeCodeCamp certification projects: survey form, product landing page, documentation page, tribute page and portfolio.','مشاريع شهادة freeCodeCamp: نموذج استبيان وصفحة منتج وصفحة توثيق وصفحة تكريم وموقع شخصي.','Personal project','مشروع شخصي','','','2025','2025','1','100','0','0','100','117','','https://github.com/Oelsayed99/freecodecamp-responsive-projects','freeCodeCamp certification projects: survey form, product landing page, documentation page, tribute page and portfolio.','مشاريع شهادة freeCodeCamp: نموذج استبيان وصفحة منتج وصفحة توثيق وصفحة تكريم وموقع شخصي.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='responsive-web-design');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='HTML5/CSS3' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Learning' LIMIT 1;
INSERT INTO projects (title_en,title_ar,slug,section_id,status_id,featured_order,visibility,thumbnail,hero_image,short_description_en,short_description_ar,my_role_en,my_role_ar,company_en,company_ar,duration_en,duration_ar,team_size,contribution_percentage,user_count,performance_score,completion_percentage,display_order,project_url,github_url,description_en,description_ar,problem_en,problem_ar,solution_en,solution_ar,architecture_en,architecture_ar,challenges_en,challenges_ar,lessons_learned_en,lessons_learned_ar) VALUES ('Self-Hosted Automation Stack','منصة أتمتة مستضافة ذاتيًا','self-hosted-automation','6','3',NULL,'published','/assets/images/projects/self-hosted-automation.webp','/assets/images/projects/self-hosted-automation-hero.webp','n8n in Docker on an Ubuntu VPS, reached through a Cloudflare Tunnel instead of a public port.','n8n داخل Docker على خادم Ubuntu، يُوصل إليه عبر Cloudflare Tunnel بدلًا من منفذ عام.','Setup and operations','الإعداد والتشغيل','','','2025 – present','2025 – الآن','1','100','0','0','100','118','','','n8n in Docker on an Ubuntu VPS, reached through a Cloudflare Tunnel instead of a public port.','n8n داخل Docker على خادم Ubuntu، يُوصل إليه عبر Cloudflare Tunnel بدلًا من منفذ عام.','','','','','','','','','','');
SET @pid = (SELECT id FROM projects WHERE slug='self-hosted-automation');
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='n8n' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Docker' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Linux' LIMIT 1;
INSERT IGNORE INTO project_technologies (project_id, technology_id) SELECT @pid, id FROM technologies WHERE name='Cloudflare' LIMIT 1;
INSERT IGNORE INTO project_tags (project_id, tag_id) SELECT @pid, id FROM tags WHERE name_en='Automation' LIMIT 1;
