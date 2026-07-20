<?php
namespace app\models;

class ProjectStatus extends Model {
    public static function all() {
        return self::query("SELECT * FROM project_statuses ORDER BY display_order, id")->fetchAll();
    }

    public static function getActive() {
        return self::query("SELECT * FROM project_statuses WHERE active = 1 ORDER BY display_order, id")->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM project_statuses WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO project_statuses (name_en, name_ar, icon, color, display_order, active) VALUES (?, ?, ?, ?, ?, ?)";
        self::query($sql, [
            $data['name_en'],
            $data['name_ar'],
            $data['icon'] ?? '',
            $data['color'] ?? '',
            $data['display_order'] ?? 0,
            $data['active'] ?? 1
        ]);
        return self::connect()->lastInsertId();
    }

    public static function update($id, $data) {
        $sql = "UPDATE project_statuses SET name_en = ?, name_ar = ?, icon = ?, color = ?, display_order = ?, active = ? WHERE id = ?";
        return self::query($sql, [
            $data['name_en'],
            $data['name_ar'],
            $data['icon'] ?? '',
            $data['color'] ?? '',
            $data['display_order'] ?? 0,
            $data['active'] ?? 1,
            $id
        ]);
    }

    public static function delete($id) {
        return self::query("DELETE FROM project_statuses WHERE id = ?", [$id]);
    }
}
