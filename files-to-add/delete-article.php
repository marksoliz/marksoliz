<?php
require_once "init.php";
checkUserLoggedIn();

if (isPostRequest()) {
    $articleId = getPostData('article_id');
    $article = new Article();




    if ($article->deleteArticleWithImage($articleId)) {
        redirect('admin.php');
    } else {
        echo "Failed to delete article";
    }
}
