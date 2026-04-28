<?php
define('BASE_PATH', __DIR__);
require_once 'app/database.php';
$stmt = $db->query("SELECT * FROM translations");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($results);
