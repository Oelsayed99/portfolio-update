<?php
namespace app\models;

class Tag extends Model {
    public static function all() {
        return self::query("SELECT * FROM tags ORDER BY name_en ASC")->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM tags WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function findBySlug($slug) {
        return self::query("SELECT * FROM tags WHERE slug = ? LIMIT 1", [$slug])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO tags (name_en, name_ar, slug) VALUES (?, ?, ?)";
        self::query($sql, [
            $data['name_en'],
            $data['name_ar'],
            $data['slug']
        ]);
        return self::connect()->lastInsertId();
    }

    public static function update($id, $data) {
        $sql = "UPDATE tags SET name_en = ?, name_ar = ?, slug = ? WHERE id = ?";
        return self::query($sql, [
            $data['name_en'],
            $data['name_ar'],
            $data['slug'],
            $id
        ]);
    }

    public static function delete($id) {
        return self::query("DELETE FROM tags WHERE id = ?", [$id]);
    }
}
