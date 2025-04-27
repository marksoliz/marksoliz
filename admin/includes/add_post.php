<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryId = $_POST['category_id'];
    $tags = $_POST['tags'];
    $minutes = $_POST['minutes'];
    $featured = isset($_POST['featured']) ? 1 : 0;
    $status = $_POST['status'];
    $date = date('Y-m-d H:i:s'); // Current timestamp

    $article = new Article();
    $message = '';
    $error = '';

    // Handle image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $uploadDir = "assets/blogImages/"; // Relative path to the upload directory
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], base_path($imagePath))) {
            $image = $imagePath; // Store the relative path in the database
        } else {
            $error = "Failed to upload image.";
        }
    }

    // Create the article
    if (empty($error) && $article->createArticle($title, $date, $content, $image, $status, $categoryId, $tags, $minutes, $featured)) {
        $message = "Blog post created successfully! View All Posts <a href='index.php?source=view_all_posts'>here</a>.";
    } else {
        $error = $error ?: "Failed to create blog post.";
    }
}
?>



<div class="container mt-4">
    <h2>Create Blog Post</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-success'>$message</div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <div class="row justify-content-center">
        <div class="col-lg-8"> <!-- Adjust the width using Bootstrap's grid system -->
            <form method="POST" action="" enctype="multipart/form-data" onsubmit="return submitForm();">
                <div class="mb-3 d-flex justify-content-between align-items-center"> <!-- Flex container -->
                    <!-- Category Dropdown -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <?php
                            // Fetch all categories using the getAllCategories() method
                            $category = new Category();
                            $categories = $category->getAllCategories();

                            // Loop through the categories and display them as options
                            foreach ($categories as $cat) {
                                echo '<option value="' . htmlspecialchars($cat->id) . '">' . htmlspecialchars($cat->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Status Dropdown -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <!-- Number Input -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="minutes" class="form-label">Minutes Read</label>
                        <input type="number" class="form-control" id="minutes" name="minutes" min="1" max="10" required>
                    </div>

                    <!-- Slider Switch -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="featured" class="form-label">Featured</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured">
                            <label class="form-check-label" for="featured">Yes</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3" id="editor">

                    <label for="content" class="form-label"></label>
                    <textarea class="form-control" id="summernote" name="content" rows="5" required></textarea>
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
    </div>
</div>