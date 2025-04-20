<?php
require_once '../init.php';
checkUserLoggedIn();

if (isPostRequest()) {
    $articleId = getPostData('article_id');
    $article = new Article();




    if ($article->deleteArticleWithImage($articleId)) {
        redirect('admin/index.php?source=view_all_posts&deleted=success');
    } else {
        echo "Failed to delete article";
    }
}
