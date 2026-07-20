<?php
namespace app\models;

class Media extends Model {
    public static function all($folder = null) {
        if ($folder) {
            return self::query("SELECT * FROM media WHERE folder = ? ORDER BY created_at DESC", [$folder])->fetchAll();
        }
        return self::query("SELECT * FROM media ORDER BY created_at DESC")->fetchAll();
    }

    public static function getFolders() {
        return self::query("SELECT DISTINCT folder FROM media ORDER BY folder ASC")->fetchAll();
    }

    public static function find($id) {
        return self::query("SELECT * FROM media WHERE id = ? LIMIT 1", [$id])->fetch();
    }

    public static function create($data) {
        $sql = "INSERT INTO media (filename, filepath, file_type, file_size, folder) VALUES (?, ?, ?, ?, ?)";
        self::query($sql, [
            $data['filename'],
            $data['filepath'],
            $data['file_type'],
            $data['file_size'],
            $data['folder'] ?? 'uploads'
        ]);
        return self::connect()->lastInsertId();
    }

    public static function delete($id) {
        $item = self::find($id);
        if ($item) {
            // Find absolute path in workspace
            $physicalPath = dirname(dirname(__DIR__)) . '/public' . $item['filepath'];
            if (file_exists($physicalPath)) {
                @unlink($physicalPath);
            }
            return self::query("DELETE FROM media WHERE id = ?", [$id]);
        }
        return false;
    }
}
