<?php
namespace app\models;

class Technology extends Model {
    public static function all() {
        return self::query("SELECT * FROM technologies ORDER BY category, name ASC")->fetchAll();
    }

    public static function getByCategory($category) {
        return self::query("SELECT * FROM technologies WHERE category = ? ORDER BY name ASC", [$category])->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM technologies WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO technologies (name, icon, color, category) VALUES (?, ?, ?, ?)";
        self::query($sql, [
            $data['name'],
            $data['icon'] ?? '',
            $data['color'] ?? '',
            $data['category']
        ]);
        return self::connect()->lastInsertId();
    }

    public static function update($id, $data) {
        $sql = "UPDATE technologies SET name = ?, icon = ?, color = ?, category = ? WHERE id = ?";
        return self::query($sql, [
            $data['name'],
            $data['icon'] ?? '',
            $data['color'] ?? '',
            $data['category'],
            $id
        ]);
    }

    public static function delete($id) {
        return self::query("DELETE FROM technologies WHERE id = ?", [$id]);
    }
}
