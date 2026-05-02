<?php
require_once '../auth.php';

use app\models\Skill;

// Ensure the user is logged in
if (!isset($_SESSION['admin_user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $category = trim($input['category'] ?? '');
    $name_en = trim($input['name_en'] ?? '');
    $name_ar = trim($input['name_ar'] ?? $name_en);

    if (empty($category) || empty($name_en)) {
        http_response_code(400);
        echo json_encode(['error' => 'Category and skill name are required']);
        exit;
    }

    try {
        $id = Skill::create([
            'category' => $category,
            'name_en' => $name_en,
            'name_ar' => $name_ar,
            'sort_order' => 0
        ]);
        echo json_encode(['success' => true, 'id' => $id, 'name_en' => $name_en, 'name_ar' => $name_ar]);
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} elseif ($method === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = intval($input['id'] ?? 0);

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Valid skill ID is required']);
        exit;
    }

    try {
        Skill::delete($id);
        echo json_encode(['success' => true]);
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
