<?php
require_once __DIR__ . '/init.php';
header('Content-Type: application/json');

$responce = ['success' => false, 'message' => ''];

if (isPostRequest()) {

    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['article_ids']) && is_array($data['article_ids'])) {

        $articleIds = $data['article_ids'];

        try {
            $article = new Article();
            $article->deleteMultipleArticlesWithImage($articleIds);

            $responce['success'] = true;
            $responce['message'] = 'Articles deleted successfully!';
        } catch (Exception $e) {
            $responce['message'] = 'Error deleting articles: ' . $e->getMessage();
        }
    }
}

echo json_encode($responce);
