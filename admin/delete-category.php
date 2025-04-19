<?php
require_once '../init.php';
checkUserLoggedIn();

if (isPostRequest()) {
    $messageId = getPostData('message_id', null);
    $contact = new Contact();

    if ($contact->deleteContactFormSubmission($messageId)) {
        redirect('admin/index.php?source=contact_form');
    } else {
        $_SESSION['error'] = "Failed to delete message.";
    }
}
