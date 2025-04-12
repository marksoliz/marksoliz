<?php
require_once '../init.php'; // Include necessary files
checkUserLoggedIn();

header('Content-Type: application/json');

$responce = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['user_ids']) && is_array($data['user_ids'])) {

        $userIds = $data['user_ids'];

        try {

            $user = new User();
            $user->deleteSelectedUsers($userIds);
            $responce['success'] = true;
            $responce['message'] = 'Users deleted successfully!';
        } catch (Exception $e) {
            $responce['message'] = 'Error deleting users: ' . $e->getMessage();
        }
    } else {
        $responce['message'] = 'Invalid request!';
    }
} else {
    $responce['message'] = 'Invalid request!';
}
echo json_encode($responce);
