<?php
require_once '../init.php'; // Include necessary files
checkUserLoggedIn();
if (isPostRequest()) {
    $user = new User();

    $count = $_POST['userCount'];

    if ($user->generateDummyUsers($count)) {
        redirect('admin/index.php?source=view_all_users');
        exit;
    }
}
