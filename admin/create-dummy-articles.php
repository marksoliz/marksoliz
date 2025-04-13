<?php
require_once '../init.php'; // Include necessary files
checkUserLoggedIn();
if (isPostRequest()) {
    $article = new Article();

    $count = $_POST['articleCount'];

    if ($article->generateDummyData($count)) {
        redirect('admin/index.php?source=view_all_posts');
        exit;
    }
}
