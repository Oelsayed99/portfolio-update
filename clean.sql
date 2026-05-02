-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: portfolio
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `journey`
--

DROP TABLE IF EXISTS `journey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `journey` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `tag_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side` enum('left','right') COLLATE utf8mb4_unicode_ci DEFAULT 'left',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journey`
--

LOCK TABLES `journey` WRITE;
/*!40000 ALTER TABLE `journey` DISABLE KEYS */;
INSERT INTO `journey` VALUES (9,'2021 — Foundation','2021 — Foundation','Started My Journey in Web Development','بدأت رحلتي في مجال تطوير المواقع الإلكترونية','Began building web applications while studying, taking on freelance projects and learning full-stack development fundamentals.','بدأت رحلتي في تطوير الويب أثناء الدراسة من خلال العمل الحر وتعلم أساسيات تطوير التطبيقات بشكل متكامل.','Learning','تعلُّم','learning','left','','2026-05-02 21:10:24'),(10,'2021 – 2022','2021 – 2022','Deep Learning & Big Data Internship  at Misr University for Science and Technology','Deep Learning & Big Data Internship  at Misr University for Science and Technology','Completed intensive training in AI, Machine Learning, and Big Data, and developed a visual recognition project.','أكملت تدريبًا مكثفًا في الذكاء الاصطناعي والتعلم الآلي والبيانات الضخمة، وقمت بتطوير مشروع للتعرف على الصور.','Certification / Training','Certification / Training','project','right','/assets/uploads/1777756370_must.jpg','2026-05-02 21:12:50'),(11,'2022 — Growth Phase','2022 — Growth Phase','AI Research Internship in India  at Vellore Institute of Technology','AI Research Internship in India  at Vellore Institute of Technology','Worked on a deep learning project for detecting and classifying crop diseases using real-world datasets.','عملت على مشروع باستخدام التعلم العميق لاكتشاف وتصنيف أمراض المحاصيل باستخدام بيانات حقيقية.','Research','بحث','project','left','/assets/uploads/1777756506_vit.jpg','2026-05-02 21:15:06'),(12,'2023 — Real-World Experience','2023 — Real-World Experience','Customer Service Role (English Support)','وظيفة خدمة العملاء (دعم اللغة الإنجليزية)','Developed strong communication, problem-solving, and client-handling skills while supporting real users.','طورت مهارات التواصل وحل المشكلات والتعامل مع العملاء من خلال العمل مع مستخدمين حقيقيين.','Experience','خبرة','project','right','/assets/uploads/1777756669_concentrix.jpg','2026-05-02 21:17:49'),(13,'2024 — Career Breakthrough','2024 - انطلاقة مهنية','Full Stack Developer at all-inkl.com – Dubai','مطور تطبيقات متكاملة  all-inkl.com – Dubai','Started working on production-level systems including server management platforms, mailing systems, and internal tools.\r\n\r\nAR:\r\n','بدأت العمل على أنظمة إنتاجية تشمل إدارة الخوادم، أنظمة البريد، وأدوات داخلية للشركات.','','','career','left','/assets/uploads/1777756946_all-inkl-haus-schriftzug.jpg','2026-05-02 21:21:33'),(14,'2021 – Present','2021 – Present','Building Scalable Systems','بناء أنظمة قابلة للتطوير','Continuously developing high-performance applications and refining backend architecture, security, and system design skills.','أعمل باستمرار على تطوير تطبيقات عالية الأداء وتحسين بنية الأنظمة الخلفية والأمان وتصميم الأنظمة.','Growth','Growth','project','right','/assets/uploads/1777757209_download.png','2026-05-02 21:26:49');
/*!40000 ALTER TABLE `journey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('pro','live') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tech_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tech_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icons` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (17,'pro','Server & Domain Management System','نظام إدارة الخوادم والنطاقات','Production-grade control panel for managing servers and domains, focused on performance, security, and system-level operations.','نظام احترافي لإدارة الخوادم والنطاقات مع التركيز على الأداء والأمان وإدارة الأنظمة.','','','','https://kas.all-inkl.com/','fa-brands fa-php, fa-brands fa-js, fa-solid fa-code','2026-05-02 19:23:07'),(18,'pro','Webmail Platform','منصة البريد الإلكتروني','Custom-built mailing system for managing communication workflows and email operations efficiently.','نظام بريد إلكتروني مخصص لإدارة عمليات التواصل والبريد بكفاءة.','','','','https://webmail.all-inkl.com/','fa-brands fa-php, fa-brands fa-js, fa-solid fa-code','2026-05-02 19:34:49'),(19,'pro','Task & Workflow System','نظام المهام وسير العمل','A collaborative platform for managing tasks and workflows, designed to improve team productivity.  Inspired by Monday.com','منصة لإدارة المهام وسير العمل تساعد على تحسين إنتاجية الفرق.','','','','https://sait.munnich.it/','fa-brands fa-php, fa-brands fa-js, fa-solid fa-code','2026-05-02 19:36:48'),(20,'live','Flow egy','Flow egy','Engineering Excellence. Designed to Last.','التميز الهندسي. مُصمم ليدوم.','Premium finishing and structural integrity for the modern era. We combine technical mastery with an artistic eye to create spaces that define luxury.\r\n\r\n','تشطيبات ممتازة وسلامة إنشائية للعصر الحديث. نحن نجمع بين الإتقان التقني والنظرة الفنية لإنشاء مساحات تُعرّف الفخامة.\r\n\r\n','/assets/uploads/1777754150_Screenshot 2026-05-03 003314.png','https://flow-egy.com/','','2026-05-02 20:35:50');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'backend','PHP','PHP',1,'2026-05-02 20:45:09'),(2,'backend','Laravel','Laravel',2,'2026-05-02 20:45:09'),(4,'backend','Node.js','Node.js',4,'2026-05-02 20:45:09'),(5,'backend','Go','Go',5,'2026-05-02 20:45:10'),(6,'frontend','JavaScript','JavaScript',1,'2026-05-02 20:45:10'),(7,'frontend','React','React',2,'2026-05-02 20:45:10'),(9,'frontend','HTML5/CSS3','HTML5/CSS3',4,'2026-05-02 20:45:10'),(10,'database','SQL','SQL',1,'2026-05-02 20:45:10'),(11,'database','MySQL','MySQL',2,'2026-05-02 20:45:10'),(12,'database','PostgreSQL','PostgreSQL',3,'2026-05-02 20:45:10'),(14,'database','MongoDB','MongoDB',5,'2026-05-02 20:45:10'),(17,'backend','Python','Python',0,'2026-05-02 20:49:59'),(19,'backend','System Architecture','System Architecture',0,'2026-05-02 20:54:17'),(20,'backend','Authentication & Security','Authentication & Security',0,'2026-05-02 20:54:25'),(21,'frontend','UI Development','UI Development',0,'2026-05-02 20:54:42');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `msgid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en` text COLLATE utf8mb4_unicode_ci,
  `ar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `msgid` (`msgid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'nav_home','Home','الرئيسية','2026-04-29 16:53:45'),(2,'nav_about','About','من أنا','2026-04-29 16:53:45'),(3,'nav_projects','Projects','المشاريع','2026-04-29 16:53:45'),(4,'nav_blog','Journey & Updates','رحلتي وتحديثاتي','2026-04-29 16:53:45'),(5,'nav_contact','Contact','اتصل بي','2026-04-29 16:53:45'),(6,'nav_work','Work','الأعمال','2026-04-29 16:53:45'),(7,'nav_services','Services','الخدمات','2026-04-29 16:53:45'),(8,'nav_get_in_touch','Get in Touch','تواصل معي','2026-04-29 16:53:45'),(9,'hero_hello','I build high-performance web systems from scratch.','أبني أنظمة ويب عالية الأداء من الصفر','2026-04-29 16:53:45'),(10,'hero_name','Omar Elsayed','عمر السيد','2026-04-29 16:53:45'),(11,'hero_title','Full Stack Developer | Backend-Focused | System Builder','مطور تطبيقات ويب متكامل | متخصص في الأنظمة الخلفية | مطوّر أنظمة','2026-04-29 16:53:45'),(12,'hero_desc','I design and develop scalable, secure web applications using native technologies and modern frameworks like Laravel. From server management systems to full SaaS platforms, I focus on performance, architecture, and real-world usability.','أقوم بتصميم وتطوير تطبيقات ويب قابلة للتوسع وآمنة باستخدام تقنيات برمجية أصلية وأطر عمل حديثة مثل Laravel. بدءًا من أنظمة إدارة الخوادم إلى منصات SaaS متكاملة، أركز على الأداء، وهيكلة الأنظمة، وتجربة الاستخدام الواقعية.','2026-04-29 16:53:45'),(13,'btn_hire','Get In Touch','تواصل معي','2026-04-29 16:53:45'),(14,'btn_projects','View My Work','استعرض أعمالي','2026-04-29 16:53:45'),(15,'about_heading','About Omar.','عن عمر.','2026-04-29 16:53:45'),(16,'about_subtitle','Crafting High-Performance Backend Systems','بناء أنظمة خلفية عالية الأداء','2026-04-29 16:53:45'),(17,'about_pro_story_title','Professional Story','القصة المهنية','2026-04-29 16:53:45'),(18,'about_pro_story','I’m a Full Stack Developer focused on building high-performance web systems with strong backend architecture.\n\nMy journey started with a deep interest in how systems work behind the scenes—how performance, security, and structure come together to create reliable applications.\n\nToday, I develop production-level systems, including server management platforms, mailing systems, and workflow tools, using native technologies and modern frameworks like Laravel.','أنا مطور تطبيقات ويب متكامل أركز على بناء أنظمة عالية الأداء مع اهتمام خاص بالأنظمة الخلفية.\n\nبدأت رحلتي بشغف لفهم كيفية عمل الأنظمة من الداخل—كيف يجتمع الأداء، الأمان، وهيكلة النظام لبناء تطبيقات قوية وموثوقة.\n\nأعمل حاليًا على تطوير أنظمة إنتاجية مثل أنظمة إدارة الخوادم، وأنظمة البريد، ومنصات إدارة المهام باستخدام تقنيات برمجية أصلية وأطر عمل حديثة مثل Laravel.','2026-04-29 16:53:45'),(19,'about_arch_title','Backend Architecture & Performance','هندسة الخلفية والأداء','2026-04-29 16:53:45'),(20,'about_arch_desc','I specialize in designing scalable backend systems with a focus on performance, security, and maintainability.\nI work extensively with native PHP and SQL, building systems from scratch when control and efficiency are critical.','أختص في تصميم أنظمة خلفية قابلة للتوسع مع التركيز على الأداء والأمان وسهولة الصيانة.\nأعمل بشكل أساسي باستخدام PHP و SQL، وأقوم ببناء الأنظمة من الصفر عند الحاجة للتحكم الكامل والكفاءة العالية.','2026-04-29 16:53:45'),(21,'about_skills_title','Skills & Expertise','المهارات والخبرات','2026-04-29 16:53:45'),(22,'skill_backend','Backend','الخلفية','2026-04-29 16:53:45'),(23,'skill_frontend','Frontend','الواجهة','2026-04-29 16:53:45'),(24,'skill_database','Database','قواعد البيانات','2026-04-29 16:53:45'),(25,'projects_heading','Portfolio Projects','مشاريع المحفظة','2026-04-29 16:53:45'),(26,'projects_subtitle','Exploring a range of professional and live software engineering work.','استكشاف مجموعة من الأعمال الهندسية البرمجية المهنية والحية.','2026-04-29 16:53:45'),(27,'projects_pro_title','Core Systems','الأنظمة الأساسية','2026-04-29 16:53:45'),(28,'projects_live_title','Selected Projects','مشاريع مختارة','2026-04-29 16:53:45'),(29,'projects_restricted','Restricted - Login Required','مقيد - تسجيل الدخول مطلوب','2026-04-29 16:53:45'),(30,'btn_view_live','View Live','عرض مباشر','2026-04-29 16:53:45'),(31,'proj_server_title','Server Management Dashboard','لوحة إدارة الخوادم','2026-04-29 16:53:45'),(32,'proj_webmail_title','Secure Webmail Client','عميل بريد إلكتروني آمن','2026-04-29 16:53:45'),(33,'proj_crm_title','Enterprise CRM Platform','منصة CRM للمؤسسات','2026-04-29 16:53:45'),(34,'proj_fashion_title','Fashion Hub E-Commerce','متجر أزياء إلكتروني','2026-04-29 16:53:45'),(35,'proj_travel_title','Travel Booking Portal','بوابة حجز السفر','2026-04-29 16:53:45'),(36,'proj_chatbot_title','AI Chatbot Application','تطبيق روبوت محادثة ذكي','2026-04-29 16:53:45'),(37,'proj_data_title','Data Visualization Dashboard','لوحة تصور البيانات','2026-04-29 16:53:45'),(38,'journey_heading','JOURNEY & UPDATES','الرحلة والتحديثات','2026-04-29 16:53:46'),(39,'journey_subtitle','A timeline of professional milestones.','جدول زمني للإنجازات المهنية.','2026-04-29 16:53:46'),(40,'journey_tag_project','PROJECT','مشروع','2026-04-29 16:53:46'),(41,'journey_1_title','Launched \"Apex Finance\" Platform','إطلاق منصة \"أبيكس فاينانس\"','2026-04-29 16:53:46'),(42,'journey_2_title','Promoted to Senior Software Engineer','ترقية إلى مهندس برمجيات أول','2026-04-29 16:53:46'),(43,'contact_heading','CONTACT','اتصل بنا','2026-04-29 16:53:46'),(44,'contact_subtitle','Get in touch','تواصل معنا','2026-04-29 16:53:46'),(45,'contact_email','om.he.els@gmail.com','om.he.els@gmail.com','2026-04-29 16:53:46'),(46,'contact_github','github.com/Oelsayed99','github.com/Oelsayed99','2026-04-29 16:53:46'),(47,'contact_linkedin','linkedin.com/in/omar-elsayed-1162ab1b0','linkedin.com/in/omar-elsayed-1162ab1b0','2026-04-29 16:53:46'),(48,'form_name','Name','الاسم','2026-04-29 16:53:46'),(49,'form_email','Email','البريد الإلكتروني','2026-04-29 16:53:46'),(50,'form_message','Message','الرسالة','2026-04-29 16:53:46'),(51,'form_submit','SEND MESSAGE','إرسال الرسالة','2026-04-29 16:53:46'),(52,'contact_success','Message sent successfully!','تم إرسال الرسالة بنجاح!','2026-04-29 16:53:46'),(53,'footer_rights','All Rights Reserved.','جميع الحقوق محفوظة.','2026-04-29 16:53:46');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','om.he.els@gmail.com','$2y$10$O/pMZU9Jlpnfoscx5bTpNuwkUu.CC21L0yVhQlNE5JBQiHMUOI6e.',NULL,NULL,'2026-04-29 16:53:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-02 23:34:14
