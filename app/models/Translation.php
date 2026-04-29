<?php

namespace app\models;

class Translation extends Model
{
    public static function get($msgid, $lang = 'en')
    {
        $sql = "SELECT `$lang` FROM translations WHERE msgid = ? LIMIT 1";
        $stmt = self::query($sql, [$msgid]);
        $result = $stmt->fetch();
        return $result[$lang] ?? $msgid;
    }

    public static function getWithEn($msgid, $lang = 'en')
    {
        $sql = "SELECT `$lang`, `en` FROM translations WHERE msgid = ? LIMIT 1";
        $stmt = self::query($sql, [$msgid]);
        return $stmt->fetch();
    }

    public static function update($msgid, $lang, $text)
    {
        // Sanitize column name (whitelist only)
        $allowed = ['en', 'ar'];
        if (!in_array($lang, $allowed)) return false;

        $sql = "UPDATE translations SET `$lang` = ? WHERE msgid = ?";
        $stmt = self::query($sql, [$text, $msgid]);
        return $stmt->rowCount() > 0;
    }

    public static function count()
    {
        return self::query("SELECT COUNT(*) FROM translations")->fetchColumn();
    }

    public static function seed($translations)
    {
        $stmt = self::connect()->prepare("INSERT IGNORE INTO translations (msgid, en, ar) VALUES (?, ?, ?)");
        foreach ($translations as $t) {
            $stmt->execute($t);
        }
    }
}
