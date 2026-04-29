<?php
require_once '../auth.php';

use app\models\Translation;

// Ensure the user is logged in
if (!isset($_SESSION['admin_user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    $msgid = $input['msgid'] ?? '';
    $language = $input['language'] ?? '';
    $new_text = $input['new_text'] ?? '';

    try {
        if (Translation::update($msgid, $language, $new_text)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'No changes made or msgid not found']);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
