<?php
$db = new PDO('sqlite:C:\Users\pc\Desktop\Projects\portfolio\database.sqlite');
$stmt = $db->query("SELECT msgid, en, ar FROM translations WHERE msgid LIKE 'about_%' OR msgid LIKE 'skill_%' OR msgid = 'hero_name'");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
