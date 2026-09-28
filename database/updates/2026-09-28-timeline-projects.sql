-- Projects appear on the Journey timeline via projects.timeline_date. Safe to re-run.
SET NAMES utf8mb4;

-- 1. Add the column if it is missing (MySQL 8 has no ADD COLUMN IF NOT EXISTS)
SET @has_col = (SELECT COUNT(*) FROM information_schema.COLUMNS
                WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'projects' AND COLUMN_NAME = 'timeline_date');
SET @ddl = IF(@has_col = 0, 'ALTER TABLE projects ADD COLUMN timeline_date DATE NULL AFTER figma_url', 'SELECT 1');
PREPARE stmt FROM @ddl; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- 2. Date the projects that belong on the timeline (never overwrites a date set in the admin)
UPDATE projects p JOIN (
    SELECT 'portfolio-cms' slug, '2026-09-27' d UNION ALL
    SELECT 'seroevents-platform', '2026-09-22' UNION ALL
    SELECT 'pitchproof', '2026-09-05' UNION ALL
    SELECT 'monymonk', '2026-08-07' UNION ALL
    SELECT 'yaxigo-international-travel-booking-platform', '2026-07-02' UNION ALL
    SELECT 'php-auth-admin-system', '2026-06-09' UNION ALL
    SELECT 'super-speed', '2026-05-13' UNION ALL
    SELECT 'flow-egypt', '2026-02-24' UNION ALL
    SELECT 'self-hosted-automation', '2025-06-01' UNION ALL
    SELECT 'cctv-browser-viewer', '2025-03-01' UNION ALL
    SELECT 'kas-translation-system', '2024-09-01' UNION ALL
    SELECT 'kas-hosting-administration-panel', '2024-06-01' UNION ALL
    SELECT 'fruit-disease-detection', '2022-12-01'
) t ON t.slug = p.slug
SET p.timeline_date = t.d
WHERE p.timeline_date IS NULL;

-- 3. Remove the hand-written project events that the projects now replace
DELETE FROM journey WHERE title_en IN (
    'Redesigned this portfolio', 'Launched PitchProof', 'Built MonyMonk', 'Started building YaxiGo',
    'Delivered Super Speed', 'Delivered Flow Egypt', 'Self-hosted automation stack', 'Browser CCTV viewer',
    'In-app translation system', 'One search system for the whole KAS panel');
