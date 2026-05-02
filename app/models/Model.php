<?php

namespace app\models;

use PDO;
use PDOException;

abstract class Model
{
    protected static $db;

    public function __construct()
    {
        self::connect();
    }

    protected static function connect()
    {
        if (self::$db === null) {
            $host = getenv('DB_HOST') ?: 'localhost';
            $name = getenv('DB_NAME') ?: 'portfolio';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASS') ?: 'root';

            try {
                self::$db = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
        return self::$db;
    }

    protected static function query($sql, $params = [])
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
