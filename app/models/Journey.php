<?php
namespace app\models;

class Journey extends Model {
    public static function all() {
        return self::query("SELECT * FROM journey ORDER BY created_at DESC")->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM journey WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO journey (date_en, date_ar, title_en, title_ar, description_en, description_ar, tag_en, tag_ar, tag_type, side, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return self::query($sql, [
            $data['date_en'],
            $data['date_ar'],
            $data['title_en'],
            $data['title_ar'],
            $data['description_en'],
            $data['description_ar'],
            $data['tag_en'],
            $data['tag_ar'],
            $data['tag_type'],
            $data['side'],
            $data['image']
        ]);
    }

    public static function update($id, $data) {
        $sql = "UPDATE journey SET date_en=?, date_ar=?, title_en=?, title_ar=?, description_en=?, description_ar=?, tag_en=?, tag_ar=?, tag_type=?, side=?, image=? WHERE id=?";
        return self::query($sql, [
            $data['date_en'],
            $data['date_ar'],
            $data['title_en'],
            $data['title_ar'],
            $data['description_en'],
            $data['description_ar'],
            $data['tag_en'],
            $data['tag_ar'],
            $data['tag_type'],
            $data['side'],
            $data['image'],
            $id
        ]);
    }

    public static function delete($id) {
        return self::query("DELETE FROM journey WHERE id = ?", [$id]);
    }
}
