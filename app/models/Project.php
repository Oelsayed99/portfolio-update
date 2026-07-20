<?php
namespace app\models;

use PDO;

class Project extends Model {
    public static function all($includeDrafts = true) {
        $where = $includeDrafts ? "" : "WHERE p.visibility = 'published'";
        $sql = "SELECT p.*, s.name_en AS section_name_en, s.name_ar AS section_name_ar, s.slug AS section_slug,
                       st.name_en AS status_name_en, st.name_ar AS status_name_ar, st.icon AS status_icon, st.color AS status_color
                FROM projects p
                LEFT JOIN project_sections s ON p.section_id = s.id
                LEFT JOIN project_statuses st ON p.status_id = st.id
                $where
                ORDER BY p.display_order ASC, p.created_at DESC";
        return self::query($sql)->fetchAll();
    }

    public static function getBySection($sectionSlug, $includeDrafts = false) {
        $whereVisibility = $includeDrafts ? "" : "AND p.visibility = 'published'";
        $sql = "SELECT p.*, s.name_en AS section_name_en, s.name_ar AS section_name_ar, s.slug AS section_slug,
                       st.name_en AS status_name_en, st.name_ar AS status_name_ar, st.icon AS status_icon, st.color AS status_color
                FROM projects p
                LEFT JOIN project_sections s ON p.section_id = s.id
                LEFT JOIN project_statuses st ON p.status_id = st.id
                WHERE s.slug = ? $whereVisibility
                ORDER BY p.display_order ASC, p.created_at DESC";
        return self::query($sql, [$sectionSlug])->fetchAll();
    }

    public static function getFeatured($includeDrafts = false) {
        $whereVisibility = $includeDrafts ? "" : "AND p.visibility = 'published'";
        $sql = "SELECT p.*, s.name_en AS section_name_en, s.name_ar AS section_name_ar, s.slug AS section_slug,
                       st.name_en AS status_name_en, st.name_ar AS status_name_ar, st.icon AS status_icon, st.color AS status_color
                FROM projects p
                LEFT JOIN project_sections s ON p.section_id = s.id
                LEFT JOIN project_statuses st ON p.status_id = st.id
                WHERE p.featured_order IS NOT NULL $whereVisibility
                ORDER BY p.featured_order ASC, p.created_at DESC";
        return self::query($sql)->fetchAll();
    }

    public static function find($id) {
        $sql = "SELECT p.*, s.name_en AS section_name_en, s.name_ar AS section_name_ar, s.slug AS section_slug,
                       st.name_en AS status_name_en, st.name_ar AS status_name_ar, st.icon AS status_icon, st.color AS status_color
                FROM projects p
                LEFT JOIN project_sections s ON p.section_id = s.id
                LEFT JOIN project_statuses st ON p.status_id = st.id
                WHERE p.id = ? LIMIT 1";
        $project = self::query($sql, [$id])->fetch();
        if ($project) {
            $project['technologies'] = self::getTechnologies($id);
            $project['tags'] = self::getTags($id);
            $project['images'] = self::getImages($id);
        }
        return $project;
    }

    public static function findBySlug($slug) {
        $sql = "SELECT p.*, s.name_en AS section_name_en, s.name_ar AS section_name_ar, s.slug AS section_slug,
                       st.name_en AS status_name_en, st.name_ar AS status_name_ar, st.icon AS status_icon, st.color AS status_color
                FROM projects p
                LEFT JOIN project_sections s ON p.section_id = s.id
                LEFT JOIN project_statuses st ON p.status_id = st.id
                WHERE p.slug = ? LIMIT 1";
        $project = self::query($sql, [$slug])->fetch();
        if ($project) {
            $project['technologies'] = self::getTechnologies($project['id']);
            $project['tags'] = self::getTags($project['id']);
            $project['images'] = self::getImages($project['id']);
        }
        return $project;
    }

    public static function generateSlug($title) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $slug = trim($slug, '-');
        
        // Ensure uniqueness
        $originalSlug = $slug;
        $count = 1;
        while (self::query("SELECT id FROM projects WHERE slug = ?", [$slug])->fetch()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        return $slug;
    }

    public static function create($data) {
        $slug = !empty($data['slug']) ? $data['slug'] : self::generateSlug($data['title_en']);
        
        $sql = "INSERT INTO projects (
            title_en, title_ar, slug, section_id, status_id, featured_order, visibility, thumbnail, hero_image,
            short_description_en, short_description_ar,
            description_en, description_ar, problem_en, problem_ar, solution_en, solution_ar, architecture_en, architecture_ar,
            challenges_en, challenges_ar, lessons_learned_en, lessons_learned_ar, my_role_en, my_role_ar,
            company_en, company_ar, client_en, client_ar, duration_en, duration_ar, team_size, contribution_percentage,
            countries_used, user_count, performance_score, completion_percentage, display_order,
            seo_title_en, seo_title_ar, seo_description_en, seo_description_ar, canonical_url, og_image, twitter_image, keywords, structured_data,
            project_url, github_url, case_study_url, demo_url, docs_url, figma_url, video_url, showcase_video
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?, ?,
            ?, ?, ?, ?, ?, ?, ?, ?
        )";

        self::query($sql, [
            $data['title_en'], $data['title_ar'], $slug, $data['section_id'], $data['status_id'], $data['featured_order'] ?? null, $data['visibility'] ?? 'published', $data['thumbnail'] ?? '', $data['hero_image'] ?? '',
            $data['short_description_en'] ?? '', $data['short_description_ar'] ?? '',
            $data['description_en'] ?? '', $data['description_ar'] ?? '', $data['problem_en'] ?? '', $data['problem_ar'] ?? '', $data['solution_en'] ?? '', $data['solution_ar'] ?? '', $data['architecture_en'] ?? '', $data['architecture_ar'] ?? '',
            $data['challenges_en'] ?? '', $data['challenges_ar'] ?? '', $data['lessons_learned_en'] ?? '', $data['lessons_learned_ar'] ?? '', $data['my_role_en'] ?? '', $data['my_role_ar'] ?? '',
            $data['company_en'] ?? '', $data['company_ar'] ?? '', $data['client_en'] ?? '', $data['client_ar'] ?? '', $data['duration_en'] ?? '', $data['duration_ar'] ?? '', $data['team_size'] ?? 1, $data['contribution_percentage'] ?? 100,
            $data['countries_used'] ?? '', $data['user_count'] ?? 0, $data['performance_score'] ?? 90, $data['completion_percentage'] ?? 100, $data['display_order'] ?? 0,
            $data['seo_title_en'] ?? '', $data['seo_title_ar'] ?? '', $data['seo_description_en'] ?? '', $data['seo_description_ar'] ?? '', $data['canonical_url'] ?? '', $data['og_image'] ?? '', $data['twitter_image'] ?? '', $data['keywords'] ?? '', $data['structured_data'] ?? '',
            $data['project_url'] ?? '', $data['github_url'] ?? '', $data['case_study_url'] ?? '', $data['demo_url'] ?? '', $data['docs_url'] ?? '', $data['figma_url'] ?? '', $data['video_url'] ?? '', $data['showcase_video'] ?? ''
        ]);

        $projectId = self::connect()->lastInsertId();

        if (!empty($data['technologies'])) {
            self::syncTechnologies($projectId, $data['technologies']);
        }
        if (!empty($data['tags'])) {
            self::syncTags($projectId, $data['tags']);
        }

        return $projectId;
    }

    public static function update($id, $data) {
        $old = self::find($id);
        if ($old) {
            if (!empty($data['thumbnail']) && $data['thumbnail'] !== $old['thumbnail']) {
                self::deleteDiskFile($old['thumbnail']);
            }
            if (!empty($data['hero_image']) && $data['hero_image'] !== $old['hero_image']) {
                self::deleteDiskFile($old['hero_image']);
            }
            if (!empty($data['showcase_video']) && $data['showcase_video'] !== $old['showcase_video']) {
                self::deleteDiskFile($old['showcase_video']);
            }
        }

        $sql = "UPDATE projects SET 
            title_en=?, title_ar=?, slug=?, section_id=?, status_id=?, featured_order=?, visibility=?, thumbnail=?, hero_image=?,
            short_description_en=?, short_description_ar=?,
            description_en=?, description_ar=?, problem_en=?, problem_ar=?, solution_en=?, solution_ar=?, architecture_en=?, architecture_ar=?,
            challenges_en=?, challenges_ar=?, lessons_learned_en=?, lessons_learned_ar=?, my_role_en=?, my_role_ar=?,
            company_en=?, company_ar=?, client_en=?, client_ar=?, duration_en=?, duration_ar=?, team_size=?, contribution_percentage=?,
            countries_used=?, user_count=?, performance_score=?, completion_percentage=?, display_order=?,
            seo_title_en=?, seo_title_ar=?, seo_description_en=?, seo_description_ar=?, canonical_url=?, og_image=?, twitter_image=?, keywords=?, structured_data=?,
            project_url=?, github_url=?, case_study_url=?, demo_url=?, docs_url=?, figma_url=?, video_url=?, showcase_video=?
            WHERE id=?";

        $result = self::query($sql, [
            $data['title_en'], $data['title_ar'], $data['slug'], $data['section_id'], $data['status_id'], $data['featured_order'] ?? null, $data['visibility'] ?? 'published', $data['thumbnail'] ?? '', $data['hero_image'] ?? '',
            $data['short_description_en'] ?? '', $data['short_description_ar'] ?? '',
            $data['description_en'] ?? '', $data['description_ar'] ?? '', $data['problem_en'] ?? '', $data['problem_ar'] ?? '', $data['solution_en'] ?? '', $data['solution_ar'] ?? '', $data['architecture_en'] ?? '', $data['architecture_ar'] ?? '',
            $data['challenges_en'] ?? '', $data['challenges_ar'] ?? '', $data['lessons_learned_en'] ?? '', $data['lessons_learned_ar'] ?? '', $data['my_role_en'] ?? '', $data['my_role_ar'] ?? '',
            $data['company_en'] ?? '', $data['company_ar'] ?? '', $data['client_en'] ?? '', $data['client_ar'] ?? '', $data['duration_en'] ?? '', $data['duration_ar'] ?? '', $data['team_size'] ?? 1, $data['contribution_percentage'] ?? 100,
            $data['countries_used'] ?? '', $data['user_count'] ?? 0, $data['performance_score'] ?? 90, $data['completion_percentage'] ?? 100, $data['display_order'] ?? 0,
            $data['seo_title_en'] ?? '', $data['seo_title_ar'] ?? '', $data['seo_description_en'] ?? '', $data['seo_description_ar'] ?? '', $data['canonical_url'] ?? '', $data['og_image'] ?? '', $data['twitter_image'] ?? '', $data['keywords'] ?? '', $data['structured_data'] ?? '',
            $data['project_url'] ?? '', $data['github_url'] ?? '', $data['case_study_url'] ?? '', $data['demo_url'] ?? '', $data['docs_url'] ?? '', $data['figma_url'] ?? '', $data['video_url'] ?? '', $data['showcase_video'] ?? '',
            $id
        ]);

        if (isset($data['technologies'])) {
            self::syncTechnologies($id, $data['technologies']);
        }
        if (isset($data['tags'])) {
            self::syncTags($id, $data['tags']);
        }

        return $result;
    }

    public static function delete($id) {
        $proj = self::find($id);
        if ($proj) {
            self::deleteDiskFile($proj['thumbnail']);
            self::deleteDiskFile($proj['hero_image']);
            self::deleteDiskFile($proj['showcase_video']);
            foreach ($proj['images'] as $img) {
                self::deleteDiskFile($img['image']);
            }
        }
        return self::query("DELETE FROM projects WHERE id = ?", [$id]);
    }

    public static function duplicate($id) {
        $proj = self::find($id);
        if (!$proj) return false;

        $proj['title_en'] .= ' (Copy)';
        $proj['title_ar'] .= ' (نسخة)';
        $proj['slug'] = self::generateSlug($proj['title_en']);
        $proj['visibility'] = 'draft';

        $techIds = array_column($proj['technologies'], 'id');
        $tagIds = array_column($proj['tags'], 'id');

        $proj['technologies'] = $techIds;
        $proj['tags'] = $tagIds;

        $newId = self::create($proj);

        // Duplicate images
        foreach ($proj['images'] as $img) {
            self::query("INSERT INTO project_images (project_id, image, alt_text_en, alt_text_ar, caption_en, caption_ar, display_order, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [
                $newId, $img['image'], $img['alt_text_en'], $img['alt_text_ar'], $img['caption_en'], $img['caption_ar'], $img['display_order'], $img['featured']
            ]);
        }

        return $newId;
    }

    public static function archive($id) {
        return self::query("UPDATE projects SET visibility = 'archived' WHERE id = ?", [$id]);
    }

    public static function getTechnologies($projectId) {
        return self::query("SELECT t.* FROM technologies t JOIN project_technologies pt ON t.id = pt.technology_id WHERE pt.project_id = ?", [$projectId])->fetchAll();
    }

    public static function syncTechnologies($projectId, $techIds) {
        self::query("DELETE FROM project_technologies WHERE project_id = ?", [$projectId]);
        if (!empty($techIds)) {
            $stmt = self::connect()->prepare("INSERT INTO project_technologies (project_id, technology_id) VALUES (?, ?)");
            foreach ($techIds as $techId) {
                $stmt->execute([$projectId, $techId]);
            }
        }
    }

    public static function getTags($projectId) {
        return self::query("SELECT t.* FROM tags t JOIN project_tags pt ON t.id = pt.tag_id WHERE pt.project_id = ?", [$projectId])->fetchAll();
    }

    public static function syncTags($projectId, $tagIds) {
        self::query("DELETE FROM project_tags WHERE project_id = ?", [$projectId]);
        if (!empty($tagIds)) {
            $stmt = self::connect()->prepare("INSERT INTO project_tags (project_id, tag_id) VALUES (?, ?)");
            foreach ($tagIds as $tagId) {
                $stmt->execute([$projectId, $tagId]);
            }
        }
    }

    public static function getImages($projectId) {
        return self::query("SELECT * FROM project_images WHERE project_id = ? ORDER BY display_order ASC", [$projectId])->fetchAll();
    }

    public static function addImage($projectId, $data) {
        $sql = "INSERT INTO project_images (project_id, image, alt_text_en, alt_text_ar, caption_en, caption_ar, display_order, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return self::query($sql, [
            $projectId,
            $data['image'],
            $data['alt_text_en'] ?? '',
            $data['alt_text_ar'] ?? '',
            $data['caption_en'] ?? '',
            $data['caption_ar'] ?? '',
            $data['display_order'] ?? 0,
            $data['featured'] ?? 0
        ]);
    }

    public static function removeImage($imageId) {
        return self::query("DELETE FROM project_images WHERE id = ?", [$imageId]);
    }

    public static function updateImagesOrder($orderMap) {
        $stmt = self::connect()->prepare("UPDATE project_images SET display_order = ? WHERE id = ?");
        foreach ($orderMap as $imageId => $order) {
            $stmt->execute([$order, $imageId]);
        }
    }

    public static function syncGitHub($id) {
        $project = self::find($id);
        if (!$project || empty($project['github_url'])) {
            return false;
        }

        // Parse github path
        $path = parse_url($project['github_url'], PHP_URL_PATH);
        $path = trim($path, '/');
        $parts = explode('/', $path);
        if (count($parts) < 2) return false;

        $ownerRepo = $parts[0] . '/' . $parts[1];

        // Curl request
        $url = "https://api.github.com/repos/" . $ownerRepo;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'OmarElsayed-PortfolioCMS');
        // If we need token: curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: token YOUR_TOKEN']);
        $response = curl_exec($ch);

        if (!$response) return false;

        $data = json_decode($response, true);
        if (isset($data['stargazers_count'])) {
            $githubStats = [
                'stars' => $data['stargazers_count'],
                'forks' => $data['forks_count'],
                'language' => $data['language'] ?? 'N/A',
                'last_commit' => $data['pushed_at'] ?? 'N/A',
                'repo_url' => $data['html_url']
            ];

            // Update in DB
            self::query("UPDATE projects SET structured_data = ? WHERE id = ?", [json_encode($githubStats), $id]);
            return true;
        }

        return false;
    }

    private static function deleteDiskFile($filepath) {
        if (empty($filepath)) return;
        if (strpos($filepath, 'http://') === 0 || strpos($filepath, 'https://') === 0) {
            return;
        }
        $fullPath = dirname(dirname(__DIR__)) . '/public' . $filepath;
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
