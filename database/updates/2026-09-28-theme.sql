-- Theme toggle labels (INSERT IGNORE: re-running keeps Visual Editor edits)
SET NAMES utf8mb4;
INSERT IGNORE INTO translations (msgid, en, ar) VALUES
('theme_system', 'Theme: system', 'المظهر: حسب النظام'),
('theme_light', 'Theme: light', 'المظهر: فاتح'),
('theme_dark', 'Theme: dark', 'المظهر: داكن');
