-- MySQL dump 10.13  Distrib 9.6.0, for macos26.4 (arm64)
--
-- Host: localhost    Database: portfolio
-- ------------------------------------------------------
-- Server version	9.6.0

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journey`
--

LOCK TABLES `journey` WRITE;
/*!40000 ALTER TABLE `journey` DISABLE KEYS */;
INSERT INTO `journey` VALUES (1,'2023','2023','Launched \"Apex Finance\" Platform','إطلاق منصة \"أبيكس فاينانس\"','Apex Finance description en','وصف منصة أبيكس فاينانس','PROJECT','مشروع','project','left','/assets/images/journey_apex.png','2026-07-18 13:17:14'),(2,'2022','2022','Promoted to Senior Software Engineer','ترقية إلى مهندس برمجيات أول','Promotion description en','وصف الترقية','CAREER','مسيرة','career','right','','2026-07-18 13:17:14'),(3,'2021','2021','AWS Certified Solutions Architect','شهادة مهندس حلول معتمد من AWS','AWS Cert description en','وصف شهادة AWS','CERTIFICATION','شهادة','cert','left','','2026-07-18 13:17:14'),(4,'2020','2020','Machine Learning Specialization','تخصص في تعلم الآلة','ML Specialization description en','وصف تخصص تعلم الآلة','LEARNING','تعلم','learning','right','','2026-07-18 13:17:14');
/*!40000 ALTER TABLE `journey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` int NOT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'uploads',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `alt_text_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `caption_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `caption_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `display_order` int DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `project_images_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

LOCK TABLES `project_images` WRITE;
/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
INSERT INTO `project_images` VALUES (12,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.11.20 PM.png','','','','',0,0),(13,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.15.30 PM.png','','','','',1,0),(14,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.15.09 PM.png','','','','',2,0),(15,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.14.53 PM.png','','','','',3,0),(16,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.14.33 PM.png','','','','',4,0),(17,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.13.57 PM.png','','','','',5,0),(18,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.14.14 PM.png','','','','',6,0),(19,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.15.42 PM.png','','','','',7,0),(20,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.16.00 PM.png','','','','',8,0),(21,26,'/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.16.15 PM.png','','','','',9,0);
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_sections`
--

DROP TABLE IF EXISTS `project_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_sections`
--

LOCK TABLES `project_sections` WRITE;
/*!40000 ALTER TABLE `project_sections` DISABLE KEYS */;
INSERT INTO `project_sections` VALUES (1,'Featured Projects','المشاريع المميزة','featured','Featured applications showcasing high-level development.','تطبيقات مميزة تعرض تطويرًا عالي المستوى.',1,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(2,'Professional Projects','المشاريع المهنية','professional','Production systems developed professionally.','أنظمة إنتاج تم تطويرها بشكل احترافي.',2,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(3,'Personal Projects','المشاريع الشخصية','personal','Independent applications built from scratch.','تطبيقات مستقلة تم بناؤها من الصفر.',3,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(4,'Open Source & GitHub','مشاريع مفتوحة المصدر','opensource','Publicly available tools and libraries.','أدوات ومكتبات متاحة للعامة.',4,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(5,'Currently Building','مشاريع قيد التطوير','building','Projects currently in active development.','مشاريع حاليًا قيد التطوير النشط.',5,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(6,'Experiments & Learning','تجارب وتعلم','experiments','Prototypes and technical experiments.','نماذج أولية وتجارب تقنية.',6,1,'2026-07-19 13:59:03','2026-07-19 13:59:03');
/*!40000 ALTER TABLE `project_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_statuses`
--

DROP TABLE IF EXISTS `project_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `display_order` int DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_statuses`
--

LOCK TABLES `project_statuses` WRITE;
/*!40000 ALTER TABLE `project_statuses` DISABLE KEYS */;
INSERT INTO `project_statuses` VALUES (1,'Completed','مكتمل','fa-circle-check','#22c55e',1,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(2,'In Progress','قيد التطوير','fa-spinner','#a855f7',2,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(3,'Maintenance','صيانة','fa-wrench','#f59e0b',3,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(4,'Paused','متوقف مؤقتاً','fa-circle-pause','#6b7280',4,1,'2026-07-19 13:59:03','2026-07-19 13:59:03'),(5,'Archived','مؤرشف','fa-box-archive','#ef4444',5,1,'2026-07-19 13:59:03','2026-07-19 13:59:03');
/*!40000 ALTER TABLE `project_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_tags`
--

DROP TABLE IF EXISTS `project_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_tags` (
  `project_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`project_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `project_tags_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_tags`
--

LOCK TABLES `project_tags` WRITE;
/*!40000 ALTER TABLE `project_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_technologies`
--

DROP TABLE IF EXISTS `project_technologies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_technologies` (
  `project_id` int NOT NULL,
  `technology_id` int NOT NULL,
  PRIMARY KEY (`project_id`,`technology_id`),
  KEY `technology_id` (`technology_id`),
  CONSTRAINT `project_technologies_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_technologies_ibfk_2` FOREIGN KEY (`technology_id`) REFERENCES `technologies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_technologies`
--

LOCK TABLES `project_technologies` WRITE;
/*!40000 ALTER TABLE `project_technologies` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_technologies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` int NOT NULL,
  `status_id` int NOT NULL,
  `featured_order` int DEFAULT NULL,
  `visibility` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `hero_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `short_description_en` text COLLATE utf8mb4_unicode_ci,
  `short_description_ar` text COLLATE utf8mb4_unicode_ci,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ar` text COLLATE utf8mb4_unicode_ci,
  `problem_en` text COLLATE utf8mb4_unicode_ci,
  `problem_ar` text COLLATE utf8mb4_unicode_ci,
  `solution_en` text COLLATE utf8mb4_unicode_ci,
  `solution_ar` text COLLATE utf8mb4_unicode_ci,
  `architecture_en` text COLLATE utf8mb4_unicode_ci,
  `architecture_ar` text COLLATE utf8mb4_unicode_ci,
  `challenges_en` text COLLATE utf8mb4_unicode_ci,
  `challenges_ar` text COLLATE utf8mb4_unicode_ci,
  `lessons_learned_en` text COLLATE utf8mb4_unicode_ci,
  `lessons_learned_ar` text COLLATE utf8mb4_unicode_ci,
  `my_role_en` text COLLATE utf8mb4_unicode_ci,
  `my_role_ar` text COLLATE utf8mb4_unicode_ci,
  `company_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `company_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `client_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `client_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `duration_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `duration_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `team_size` int DEFAULT '1',
  `contribution_percentage` int DEFAULT '100',
  `countries_used` text COLLATE utf8mb4_unicode_ci,
  `user_count` int DEFAULT '0',
  `performance_score` int DEFAULT '90',
  `completion_percentage` int DEFAULT '100',
  `display_order` int DEFAULT '0',
  `seo_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `seo_title_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `seo_description_en` text COLLATE utf8mb4_unicode_ci,
  `seo_description_ar` text COLLATE utf8mb4_unicode_ci,
  `canonical_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `twitter_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `structured_data` text COLLATE utf8mb4_unicode_ci,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `github_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `case_study_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `demo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `docs_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `figma_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `showcase_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `section_id` (`section_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `project_sections` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `project_statuses` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (26,'Flow Egypt','فلو إيجيبت','flow-egypt',3,1,NULL,'published','/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.11.20 PM.png','/assets/uploads/1784488880_Screenshot 2026-07-19 at 11.11.20 PM.png','A premium bilingual web platform crafted to elevate Flow Egypt\'s digital presence and corporate image.','منصة ويب ثنائية اللغة متميزة مصممة لتعزيز الحضور الرقمي لشركة فلو إيجيبت وصورتها المؤسسية.','Flow Egypt is a corporate website developed for a real estate company to showcase its services, strengthen its online presence, and provide an easy way for potential clients to explore the business and get in touch.\r\n\r\nThe project was built from the ground up, covering every stage of development—from UI/UX design and application architecture to deployment, email configuration, and production launch.','موقع Flow Egypt هو موقع إلكتروني مصمم خصيصًا لشركة عقارية لعرض خدماتها، وتعزيز حضورها الرقمي، وتوفير طريقة سهلة للعملاء المحتملين لاستكشاف أعمالها والتواصل معها.\r\n\r\nتم بناء المشروع من الصفر، وشمل جميع مراحل التطوير، بدءًا من تصميم واجهة المستخدم وتجربة المستخدم، وهيكلة التطبيق، وصولًا إلى النشر، وإعداد البريد الإلكتروني، وإطلاق الموقع رسميًا.','Flow Egypt needed a modern, professional website that reflected the company\'s brand, presented its services clearly, and supported both Arabic- and English-speaking audiences. The solution also needed to be easy to maintain and responsive across all devices.','كانت شركة فلو إيجيبت بحاجة إلى موقع إلكتروني عصري واحترافي يعكس هوية الشركة، ويعرض خدماتها بوضوح، ويدعم الجمهور الناطق باللغتين العربية والإنجليزية. كما كان من الضروري أن يكون الموقع سهل الصيانة ومتوافقًا مع جميع الأجهزة.','I designed and developed a complete custom web application using Laravel and Tailwind CSS, implementing a bilingual user experience, responsive layouts, dynamic image galleries, contact forms, and a streamlined content management workflow. The project was deployed to production with Cloudflare integration and fully configured email services.','قمت بتصميم وتطوير تطبيق ويب مخصص بالكامل باستخدام Laravel وTailwind CSS، مع توفير تجربة مستخدم ثنائية اللغة، وتصميمات متجاوبة، ومعارض صور ديناميكية، ونماذج اتصال، ونظام إدارة محتوى مبسط. تم نشر المشروع في بيئة الإنتاج مع تكامل Cloudflare وخدمات بريد إلكتروني مُهيأة بالكامل.','The application follows Laravel\'s MVC architecture, separating presentation, business logic, and data access to keep the codebase maintainable. Dynamic content is served from the backend while the frontend uses reusable components for a consistent user experience. Docker was used during development to provide a reproducible environment, and Cloudflare was configured for DNS management and performance.','','The project did not present significant technical obstacles, allowing me to focus on delivering a clean, polished, and reliable implementation. The primary objective was producing a high-quality solution that met the client\'s requirements while maintaining good development practices.','','This project reinforced the importance of managing the complete software development lifecycle independently. Working directly from initial requirements through design, implementation, deployment, and production support strengthened my ability to deliver complete web solutions while balancing technical quality with business needs.','','Full Stack Developer & UI/UX Designer','مطور برامج متكامل و مصمم واجهات','Flow Egypt','فلو إيجيبت','','','2 weeks','',1,100,'',20,70,100,0,'Flow Egypt | Full Stack Laravel Client Project | Omar Elsayed','','A bilingual corporate website developed from concept to production using Laravel, PHP, Tailwind CSS, MySQL, Docker, and Cloudflare. I was responsible for the complete project lifecycle, including design, development, deployment, and infrastructure configuration.','','','','','','{\"stars\":0,\"forks\":0,\"language\":\"Blade\",\"last_commit\":\"2026-04-07T21:13:34Z\",\"repo_url\":\"https:\\/\\/github.com\\/Oelsayed99\\/flow-corporate\"}','https://flow-egy.com/','https://github.com/Oelsayed99/flow-corporate','','','','','','/assets/uploads/1784488880_Screen Recording 2026-07-19 at 11.18.21 PM.mov','2026-07-19 19:10:32','2026-07-19 19:36:45');
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'backend','PHP','PHP',1,'2026-07-18 13:17:14'),(2,'backend','Laravel','Laravel',2,'2026-07-18 13:17:14'),(4,'backend','Node.js','Node.js',4,'2026-07-18 13:17:14'),(5,'backend','Go','Go',5,'2026-07-18 13:17:14'),(6,'frontend','JavaScript','JavaScript',1,'2026-07-18 13:17:14'),(7,'frontend','React','React',2,'2026-07-18 13:17:14'),(8,'frontend','Vue.js','Vue.js',3,'2026-07-18 13:17:14'),(9,'frontend','HTML5/CSS3','HTML5/CSS3',4,'2026-07-18 13:17:14'),(10,'database','SQL','SQL',1,'2026-07-18 13:17:14'),(11,'database','MySQL','MySQL',2,'2026-07-18 13:17:14'),(12,'database','PostgreSQL','PostgreSQL',3,'2026-07-18 13:17:14'),(14,'database','MongoDB','MongoDB',5,'2026-07-18 13:17:14'),(15,'backend','Express js','Express js',0,'2026-07-19 13:03:50'),(16,'frontend','TypeScript','TypeScript',0,'2026-07-19 13:05:37'),(17,'backend','REST APIs','REST APIs',0,'2026-07-19 13:08:59'),(18,'backend','MVC','MVC',0,'2026-07-19 13:09:08'),(19,'backend','Eloquent ORM','Eloquent ORM',0,'2026-07-19 13:09:16'),(20,'backend','Queue Systems','Queue Systems',0,'2026-07-19 13:09:24'),(21,'backend','Authentication','Authentication',0,'2026-07-19 13:09:31'),(22,'frontend','Tailwind','Tailwind',0,'2026-07-19 13:09:44'),(23,'frontend','Bootstrap','Bootstrap',0,'2026-07-19 13:09:50'),(24,'frontend','Vite','Vite',0,'2026-07-19 13:09:56'),(25,'devops','Docker','Docker',1,'2026-07-19 13:13:46'),(26,'devops','Linux','Linux',2,'2026-07-19 13:13:46'),(27,'devops','Git','Git',3,'2026-07-19 13:13:46'),(28,'devops','GitHub','GitHub',4,'2026-07-19 13:13:46'),(29,'devops','VPS Deployment','VPS Deployment',5,'2026-07-19 13:13:46'),(30,'devops','Cloudflare','Cloudflare',6,'2026-07-19 13:13:46'),(31,'devops','Nginx/OpenLiteSpeed','Nginx/OpenLiteSpeed',7,'2026-07-19 13:13:46');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Web App','تطبيق ويب','web-app','2026-07-19 13:59:03'),(2,'Mobile API','واجهة برمجة تطبيقات الهاتف','mobile-api','2026-07-19 13:59:03'),(3,'CRM','إدارة علاقات العملاء','crm','2026-07-19 13:59:03'),(4,'Fintech','التكنولوجيا المالية','fintech','2026-07-19 13:59:03'),(5,'Dashboard','لوحة تحكم','dashboard','2026-07-19 13:59:03');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `technologies`
--

DROP TABLE IF EXISTS `technologies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `technologies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `category` enum('frontend','backend','database','devops','tools') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `technologies`
--

LOCK TABLES `technologies` WRITE;
/*!40000 ALTER TABLE `technologies` DISABLE KEYS */;
INSERT INTO `technologies` VALUES (1,'PHP','fab fa-php','#777bb4','backend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(2,'Laravel','fab fa-laravel','#ff2d20','backend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(3,'Symfony','fab fa-symfony','#000000','backend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(4,'Node.js','fab fa-node-js','#339933','backend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(5,'Go','fa-brands fa-golang','#00add8','backend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(6,'JavaScript','fab fa-js','#f7df1e','frontend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(7,'React','fab fa-react','#61dafb','frontend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(8,'Vue.js','fab fa-vuejs','#4fc08d','frontend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(9,'HTML5/CSS3','fab fa-html5','#e34f26','frontend','2026-07-19 13:59:03','2026-07-19 13:59:03'),(10,'SQL','fas fa-database','#00758f','database','2026-07-19 13:59:03','2026-07-19 13:59:03'),(11,'MySQL','fas fa-server','#4479a1','database','2026-07-19 13:59:03','2026-07-19 13:59:03'),(12,'PostgreSQL','fas fa-database','#336791','database','2026-07-19 13:59:03','2026-07-19 13:59:03'),(13,'Redis','fas fa-server','#d82c20','database','2026-07-19 13:59:03','2026-07-19 13:59:03'),(14,'MongoDB','fas fa-leaf','#47a248','database','2026-07-19 13:59:03','2026-07-19 13:59:03'),(15,'Docker','fab fa-docker','#2496ed','devops','2026-07-19 13:59:03','2026-07-19 13:59:03'),(16,'Linux','fab fa-linux','#f82020','devops','2026-07-19 13:59:03','2026-07-19 13:59:03'),(17,'Git','fab fa-git-alt','#f05032','devops','2026-07-19 13:59:03','2026-07-19 13:59:03'),(18,'GitHub','fab fa-github','#181717','devops','2026-07-19 13:59:03','2026-07-19 13:59:03'),(19,'VPS Deployment','fas fa-cloud-server','#0080ff','devops','2026-07-19 13:59:03','2026-07-19 13:59:03'),(20,'Cloudflare','fab fa-cloudflare','#f38020','devops','2026-07-19 13:59:03','2026-07-19 13:59:03'),(21,'Nginx/OpenLiteSpeed','fas fa-network-wired','#009639','devops','2026-07-19 13:59:03','2026-07-19 13:59:03');
/*!40000 ALTER TABLE `technologies` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'nav_home','Home','الرئيسية','2026-07-18 13:17:14'),(2,'nav_about','About','من أنا','2026-07-18 13:17:14'),(3,'nav_projects','Projects','المشاريع','2026-07-18 13:17:14'),(4,'nav_blog','Journey & Updates','رحلتي وتحديثاتي','2026-07-18 13:17:14'),(5,'nav_contact','Contact','اتصل بي','2026-07-18 13:17:14'),(6,'nav_work','Work','الأعمال','2026-07-18 13:17:14'),(7,'nav_services','Services','الخدمات','2026-07-18 13:17:14'),(8,'nav_get_in_touch','Get in Touch','تواصل معي','2026-07-18 13:17:14'),(9,'hero_hello','Hello, I\'m','مرحباً، أنا','2026-07-18 13:17:14'),(10,'hero_name','Omar Elsayed','عمر السيد','2026-07-18 13:17:14'),(11,'hero_title','Full Stack Software Engineer.','مهندس برمجيات ومطور شامل','2026-07-18 13:17:14'),(12,'hero_desc','I build scalable web applications using Laravel, PHP, React, JavaScript, and modern cloud technologies. I enjoy designing systems, solving complex problems, and turning ideas into production-ready software.\n\nCurrently building high-performance applications while continuously expanding my expertise in software architecture, DevOps, and AI-powered automation.','إنشاء تطبيقات ويب مبتكرة وقابلة للتطوير مع التركيز على تجربة المستخدم والأداء.','2026-07-18 13:17:14'),(13,'btn_hire','Hire Me','وظفني','2026-07-18 13:17:14'),(14,'btn_projects','View Projects','عرض المشاريع','2026-07-18 13:17:14'),(15,'about_heading','About Omar.','عن عمر.','2026-07-18 13:17:14'),(16,'about_subtitle','Crafting High-Performance Software Systems','تطوير أنظمة خلفية عالية الأداء','2026-07-18 13:17:14'),(17,'about_pro_story_title','Professional Story','القصة المهنية','2026-07-18 13:17:14'),(18,'about_pro_story','I\'m a Full Stack Software Engineer passionate about building reliable, scalable software that solves real business problems.\n\nMy professional experience includes developing hosting management systems, CRM platforms, administrative dashboards, commercial websites, and large-scale web applications.\n\nI enjoy working across the entire development lifecycle—from planning system architecture and designing databases to implementing APIs, building modern user interfaces, deploying servers, and optimizing application performance.\n\nBeyond coding, I continuously study software architecture, DevOps, distributed systems, AI, and product development to become a stronger software engineer and technical leader.','أنا مهندس برمجيات متكامل، شغوف ببناء برمجيات موثوقة وقابلة للتوسع تُسهم في حل مشكلات الأعمال الحقيقية.\n\nتشمل خبرتي المهنية تطوير أنظمة إدارة الاستضافة، ومنصات إدارة علاقات العملاء (CRM)، ولوحات التحكم الإدارية، ومواقع الويب التجارية، وتطبيقات الويب واسعة النطاق.\n\nأستمتع بالعمل في جميع مراحل دورة تطوير البرمجيات، بدءًا من تخطيط بنية النظام وتصميم قواعد البيانات، وصولًا إلى تنفيذ واجهات برمجة التطبيقات (APIs)، وبناء واجهات مستخدم عصرية، ونشر الخوادم، وتحسين أداء التطبيقات.\n\nإلى جانب البرمجة، أحرص على مواصلة دراسة هندسة البرمجيات، ومنهجية DevOps، والأنظمة الموزعة، والذكاء الاصطناعي، وتطوير المنتجات، لأصبح مهندس برمجيات وقائدًا تقنيًا أكثر كفاءة.','2026-07-18 13:17:14'),(19,'about_arch_title','Backend Development & Software Architecture','هندسة الخلفية والأداء','2026-07-18 13:17:14'),(20,'about_arch_desc','I build secure, maintainable backend applications using PHP and Laravel, focusing on clean architecture, scalable APIs, efficient database design, and reliable application performance. I enjoy turning complex business requirements into well-structured software that is easy to extend and maintain.','أتخصص في تصميم وتنفيذ أنظمة خلفية عالية الإنتاجية.','2026-07-18 13:17:14'),(21,'about_skills_title','Skills & Expertise','المهارات والخبرات','2026-07-18 13:17:14'),(22,'skill_backend','Backend','الخلفية','2026-07-18 13:17:14'),(23,'skill_frontend','Frontend','الواجهة','2026-07-18 13:17:14'),(24,'skill_database','Database','قواعد البيانات','2026-07-18 13:17:14'),(25,'projects_heading','Portfolio Projects','مشاريع المحفظة','2026-07-18 13:17:14'),(26,'projects_subtitle','Exploring a range of professional and live software engineering work.','استكشاف مجموعة من الأعمال الهندسية البرمجية المهنية والحية.','2026-07-18 13:17:14'),(27,'projects_pro_title','Professional Systems','الأنظمة الاحترافية','2026-07-18 13:17:14'),(28,'projects_live_title','Live Projects','المشاريع الحية','2026-07-18 13:17:14'),(29,'projects_restricted','Restricted - Login Required','مقيد - تسجيل الدخول مطلوب','2026-07-18 13:17:14'),(30,'btn_view_live','View Live','عرض مباشر','2026-07-18 13:17:14'),(31,'proj_server_title','Server Management Dashboard','لوحة إدارة الخوادم','2026-07-18 13:17:14'),(32,'proj_webmail_title','Secure Webmail Client','عميل بريد إلكتروني آمن','2026-07-18 13:17:14'),(33,'proj_crm_title','Enterprise CRM Platform','منصة CRM للمؤسسات','2026-07-18 13:17:14'),(34,'proj_fashion_title','Fashion Hub E-Commerce','متجر أزياء إلكتروني','2026-07-18 13:17:14'),(35,'proj_travel_title','Travel Booking Portal','بوابة حجز السفر','2026-07-18 13:17:14'),(36,'proj_chatbot_title','AI Chatbot Application','تطبيق روبوت محادثة ذكي','2026-07-18 13:17:14'),(37,'proj_data_title','Data Visualization Dashboard','لوحة تصور البيانات','2026-07-18 13:17:14'),(38,'journey_heading','JOURNEY & UPDATES','الرحلة والتحديثات','2026-07-18 13:17:14'),(39,'journey_subtitle','A timeline of professional milestones.','جدول زمني للإنجازات المهنية.','2026-07-18 13:17:14'),(40,'journey_tag_project','PROJECT','مشروع','2026-07-18 13:17:14'),(41,'journey_1_title','Launched \"Apex Finance\" Platform','إطلاق منصة \"أبيكس فاينانس\"','2026-07-18 13:17:14'),(42,'journey_2_title','Promoted to Senior Software Engineer','ترقية إلى مهندس برمجيات أول','2026-07-18 13:17:14'),(43,'contact_heading','CONTACT','اتصل بنا','2026-07-18 13:17:14'),(44,'contact_subtitle','Get in touch','تواصل معنا','2026-07-18 13:17:14'),(45,'contact_email','om.he.els@gmail.com','om.he.els@gmail.com','2026-07-18 13:17:14'),(46,'contact_github','github.com/Oelsayed99','github.com/Oelsayed99','2026-07-18 13:17:14'),(47,'contact_linkedin','linkedin.com/in/omar-elsayed-1162ab1b0','linkedin.com/in/omar-elsayed-1162ab1b0','2026-07-18 13:17:14'),(48,'form_name','Name','الاسم','2026-07-18 13:17:14'),(49,'form_email','Email','البريد الإلكتروني','2026-07-18 13:17:14'),(50,'form_message','Message','الرسالة','2026-07-18 13:17:14'),(51,'form_submit','SEND MESSAGE','إرسال الرسالة','2026-07-18 13:17:14'),(52,'contact_success','Message sent successfully!','تم إرسال الرسالة بنجاح!','2026-07-18 13:17:14'),(53,'footer_rights','All Rights Reserved.','جميع الحقوق محفوظة.','2026-07-18 13:17:14'),(54,'skill_devops','DevOps','ديف أوبس','2026-07-19 13:13:46');
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
INSERT INTO `users` VALUES (1,'admin','om.he.els@gmail.com','$2y$12$jIm99B.fcbdtFjbWOqZzt.FZUfTFq/uMZsVVPK02auxU.INgTDpVq',NULL,NULL,'2026-07-18 13:17:14');
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

-- Dump completed on 2026-07-20 17:07:24
