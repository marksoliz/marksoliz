<?php
require_once '../init.php';

if (isPostRequest()) {

    if (isset($_POST['reorder_articles'])) {
        $article = new Article();
        // reorder and reset auto increment id
        $article->reorderArticles();
        redirect('admin/index.php?source=view_all_posts');
        exit;
    } else {

        echo "Something went wrong!";
        exit;
    }
}
