<?php
namespace app\models;

class Skill extends Model {
    public static function all() {
        return self::query("SELECT * FROM skills ORDER BY category, sort_order, id")->fetchAll();
    }

    public static function getByCategory($category) {
        return self::query("SELECT * FROM skills WHERE category = ? ORDER BY sort_order, id", [$category])->fetchAll();
    }

    public static function getGrouped() {
        $skills = self::all();
        $grouped = [];
        foreach ($skills as $skill) {
            $grouped[$skill['category']][] = $skill;
        }
        return $grouped;
    }

    public static function find($id) {
        return self::query("SELECT * FROM skills WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO skills (category, name_en, name_ar, sort_order) VALUES (?, ?, ?, ?)";
        self::query($sql, [
            $data['category'],
            $data['name_en'],
            $data['name_ar'] ?? $data['name_en'],
            $data['sort_order'] ?? 0
        ]);
        return self::connect()->lastInsertId();
    }

    public static function delete($id) {
        return self::query("DELETE FROM skills WHERE id = ?", [$id]);
    }
}
