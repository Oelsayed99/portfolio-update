<?php
namespace app\models;

class ProjectSection extends Model {
    public static function all() {
        return self::query("SELECT * FROM project_sections ORDER BY display_order, id")->fetchAll();
    }

    public static function getActive() {
        return self::query("SELECT * FROM project_sections WHERE active = 1 ORDER BY display_order, id")->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM project_sections WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function findBySlug($slug) {
        return self::query("SELECT * FROM project_sections WHERE slug = ? LIMIT 1", [$slug])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO project_sections (name_en, name_ar, slug, description_en, description_ar, display_order, active) VALUES (?, ?, ?, ?, ?, ?, ?)";
        self::query($sql, [
            $data['name_en'],
            $data['name_ar'],
            $data['slug'],
            $data['description_en'] ?? null,
            $data['description_ar'] ?? null,
            $data['display_order'] ?? 0,
            $data['active'] ?? 1
        ]);
        return self::connect()->lastInsertId();
    }

    public static function update($id, $data) {
        $sql = "UPDATE project_sections SET name_en = ?, name_ar = ?, slug = ?, description_en = ?, description_ar = ?, display_order = ?, active = ? WHERE id = ?";
        return self::query($sql, [
            $data['name_en'],
            $data['name_ar'],
            $data['slug'],
            $data['description_en'] ?? null,
            $data['description_ar'] ?? null,
            $data['display_order'] ?? 0,
            $data['active'] ?? 1,
            $id
        ]);
    }

    public static function delete($id) {
        return self::query("DELETE FROM project_sections WHERE id = ?", [$id]);
    }
}
