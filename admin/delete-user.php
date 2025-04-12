<?php
require_once '../init.php'; // Include necessary files
checkUserLoggedIn();
if (isPostRequest()) {
    $userId = getPostData('user_id', null);
    $user = new User();

    if ($user->deleteUser($userId)) {
        redirect('admin/index.php?source=view_all_users');
    } else {
        $_SESSION['error'] = "Failed to delete user.";
    }
}
