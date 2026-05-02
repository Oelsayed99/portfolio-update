<?php
namespace app\models;

class Project extends Model {
    public static function all() {
        return self::query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();
    }

    public static function getByType($type) {
        return self::query("SELECT * FROM projects WHERE type = ? ORDER BY created_at DESC", [$type])->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM projects WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO projects (type, title_en, title_ar, tech_en, tech_ar, description_en, description_ar, image, link, icons) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return self::query($sql, [
            $data['type'],
            $data['title_en'],
            $data['title_ar'],
            $data['tech_en'],
            $data['tech_ar'],
            $data['description_en'],
            $data['description_ar'],
            $data['image'],
            $data['link'],
            $data['icons']
        ]);
    }

    public static function update($id, $data) {
        $sql = "UPDATE projects SET type=?, title_en=?, title_ar=?, tech_en=?, tech_ar=?, description_en=?, description_ar=?, image=?, link=?, icons=? WHERE id=?";
        return self::query($sql, [
            $data['type'],
            $data['title_en'],
            $data['title_ar'],
            $data['tech_en'],
            $data['tech_ar'],
            $data['description_en'],
            $data['description_ar'],
            $data['image'],
            $data['link'],
            $data['icons'],
            $id
        ]);
    }

    public static function delete($id) {
        return self::query("DELETE FROM projects WHERE id = ?", [$id]);
    }
}
