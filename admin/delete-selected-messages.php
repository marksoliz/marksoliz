<?php
require_once '../../init.php'; // Include necessary files

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['ids']) && is_array($data['ids'])) {
        $ids = array_map('intval', $data['ids']); // Sanitize IDs

        $contact = new Contact();
        if ($contact->deleteSelectedMessages($ids)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete messages.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input.']);
    }
    exit();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit();
}
