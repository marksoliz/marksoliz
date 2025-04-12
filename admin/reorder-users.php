<?php
require_once '../init.php';
checkUserLoggedIn();

if (isPostRequest()) {
    $user = new User();

    if ($user->reorderUsers()) {
        redirect('admin/index.php?source=view_all_users');
    } else {
        $_SESSION['error'] = "Failed to reorder users.";
        redirect('admin/index.php?source=view_all_users');
    }
}
