<?php
require_once '../init.php';
checkUserLoggedIn();
// Check if the article ID is provided
if (isset($_GET['post_id'])) {
    $articleId = intval($_GET['post_id']);
    $article = new Article();
    $error = '';

    // Fetch the article data to pre-fill the form
    $articleData = $article->getArticleById($articleId);

    if (!$articleData) {
        echo "Article not found.";
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $categoryId = $_POST['category_id'];
        $tags = $_POST['tags'];
        $minutes = $_POST['minutes'];
        $featured = isset($_POST['featured']) ? 1 : 0;
        $status = $_POST['status'];
        $date = date('Y-m-d H:i:s'); // Current timestamp

        // Handle image upload
        $image = $articleData->image; // Keep the existing image by default
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                $error = "Invalid file type.";
            } else {
                $imageName = basename($_FILES['image']['name']);
                $uploadDir = "assets/blogImages/"; // Relative path to the upload directory
                $imagePath = $uploadDir . uniqid() . '-' . $imageName;

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['image']['tmp_name'], base_path($imagePath))) {
                    $image = $imagePath; // Update the image path
                } else {
                    $error = "Failed to upload image.";
                }
            }
        }

        // Update the article
        if (empty($error) && $article->updateArticle($articleId, $title, $date, $content, $image, $status, $categoryId, $tags, $minutes, $featured)) {
            // Redirect back to edit_post.php with a success message
            redirect('admin/index.php?source=edit_post&post_id=' . $articleId . '&success=1');
            exit;
        } else {
            $error = $error ?: "Failed to update blog post.";
        }
    }
} else {
    echo "Invalid article ID.";
    exit;
}
