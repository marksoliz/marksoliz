<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category_id'];
    $tags = $_POST['tags'];
    $date = date('Y-m-d H:i:s'); // Current timestamp

    $article = new Article();
    $message = '';
    $error = '';


    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../assets/blogImages/';
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image = $imagePath;
        } else {
            $error = "Failed to upload image.";
        }
    }

    // Create the article
    if (empty($error) && $article->createArticle($title, $date, $content, $image, $categoryId, $tags)) {
        $message = "Blog post created successfully!";
    } else {
        $error = $error ?: "Failed to create blog post.";
    }
}
?>

<div class="container mt-4">
    <h2>Create Blog Post</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-success'>$message</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="1">Travel</option>
                <option value="2">Lifestyle</option>
                <option value="3">Technology</option>
                <!-- Add more categories as needed -->
            </select>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags (comma-separated)</label>
            <input type="text" class="form-control" id="tags" name="tags">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary mb-4">Create Post</button>
    </form>
</div>