<?php
require_once '../init.php'; // Include necessary files
checkUserLoggedIn();
if (isPostRequest()) {
    $message = new Contact();

    $count = $_POST['messageCount'];

    if ($message->generateDummyMessages($count)) {
        redirect('admin/index.php?source=contact_form');
        exit;
    }
}
