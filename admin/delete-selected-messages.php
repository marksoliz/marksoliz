<?php
require_once '../../init.php'; // Include necessary files

header('Content-Type: application/json');

$responce = ['success' => false, 'message' => ''];

if (isPostRequest()) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['message_ids']) && is_array($data['message_ids'])) {

        $messageIds = $data['message_ids'];

        try {

            $message = new Contact();
            $message->deleteSelectedMessages($messageIds);
            $responce['success'] = true;
            $responce['message'] = 'Messages deleted successfully!';
        } catch (Exception $e) {
            $responce['message'] = 'Error deleting messages: ' . $e->getMessage();
        }
    } else {
        $responce['message'] = 'Invalid request!';
    }
} else {
    $responce['message'] = 'Invalid request!';
}
echo json_encode($responce);
