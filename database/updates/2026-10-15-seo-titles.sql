-- Shorter home/services titles (Google shows ~60 characters).
-- Only replaces the original wording, so titles edited since are kept.
SET NAMES utf8mb4;
UPDATE translations SET en = 'Omar Elsayed — Software Engineer in Dubai · AI & Automation'
 WHERE msgid = 'seo_title_home' AND en = 'Omar Elsayed — Software Engineer in Dubai · AI Systems & Automation';
UPDATE translations SET ar = 'عمر السيد — مهندس برمجيات في دبي · ذكاء اصطناعي وأتمتة'
 WHERE msgid = 'seo_title_home' AND ar = 'عمر السيد — مهندس برمجيات في دبي · أنظمة الذكاء الاصطناعي والأتمتة';
UPDATE translations SET en = 'Web Development, AI & Automation in Dubai | Omar Elsayed'
 WHERE msgid = 'seo_title_services' AND en = 'Web Development, AI & Automation Services in Dubai | Omar Elsayed';
UPDATE translations SET ar = 'تطوير الويب والذكاء الاصطناعي والأتمتة في دبي | عمر السيد'
 WHERE msgid = 'seo_title_services' AND ar = 'خدمات تطوير الويب والذكاء الاصطناعي والأتمتة في دبي | عمر السيد';
