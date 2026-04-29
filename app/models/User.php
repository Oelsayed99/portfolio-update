<?php

namespace app\models;

class User extends Model
{
    public static function findByUsername($username)
    {
        $stmt = self::query("SELECT * FROM users WHERE username = ? LIMIT 1", [$username]);
        return $stmt->fetch();
    }

    public static function findByEmail($email)
    {
        $stmt = self::query("SELECT * FROM users WHERE email = ? LIMIT 1", [$email]);
        return $stmt->fetch();
    }

    public static function findByToken($token)
    {
        $stmt = self::query("SELECT * FROM users WHERE reset_token = ? AND token_expiry > CURRENT_TIMESTAMP LIMIT 1", [$token]);
        return $stmt->fetch();
    }

    public static function create($username, $email, $password)
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        return self::query($sql, [$username, $email, $password]);
    }

    public static function delete($id)
    {
        return self::query("DELETE FROM users WHERE id = ?", [$id]);
    }

    public static function all()
    {
        return self::query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
    }

    public static function count()
    {
        return self::query("SELECT COUNT(*) FROM users")->fetchColumn();
    }

    public static function updatePassword($id, $hashedPassword)
    {
        return self::query("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?", [$hashedPassword, $id]);
    }

    public static function setResetToken($id, $token, $expiry)
    {
        return self::query("UPDATE users SET reset_token = ?, token_expiry = ? WHERE id = ?", [$token, $expiry, $id]);
    }
}
