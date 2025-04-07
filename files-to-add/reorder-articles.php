<?php
require_once __DIR__ . '/init.php';

if (isPostRequest()) {

    if (isset($_POST['reorder_articles'])) {
        $article = new Article();
        // reorder and reset auto increment id
        $article->reorderArticles();
        redirect('admin.php');
    } else {

        echo "Something went wrong!";
        exit;
    }
}
