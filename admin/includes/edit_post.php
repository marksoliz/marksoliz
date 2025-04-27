<?php
// Check if the article ID is provided
if (isset($_GET['post_id'])) {
    $articleId = intval($_GET['post_id']);
    $article = new Article();
    $message = '';
    $error = '';

    // Fetch the article data to pre-fill the form
    $articleData = $article->getArticleById($articleId);

    if (!$articleData) {
        echo "Article not found.";
        exit;
    }

    // Display success message if redirected from update-article.php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        $message = "Blog post updated successfully! View All Posts <a href='index.php?source=view_all_posts'>here</a>.";
    }
} else {
    echo "Invalid article ID.";
    exit;
}
?>

<div class="container mt-4">
    <h2>Edit Blog Post</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-success'>$message </div>"; ?>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="POST" action="update-article.php?post_id=<?php echo $articleId; ?>" enctype="multipart/form-data">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <!-- Category Dropdown -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <?php
                            $category = new Category();
                            $categories = $category->getAllCategories();

                            foreach ($categories as $cat) {
                                $selected = $cat->id == $articleData->category_id ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($cat->id) . '" ' . $selected . '>' . htmlspecialchars($cat->name) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Status Dropdown -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="draft" <?php echo ($articleData->status === 'draft') ? 'selected' : ''; ?>>Draft</option>
                            <option value="in_progress" <?php echo ($articleData->status === 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                            <option value="published" <?php echo ($articleData->status === 'published') ? 'selected' : ''; ?>>Published</option>
                            <option value="archived" <?php echo ($articleData->status === 'archived') ? 'selected' : ''; ?>>Archived</option>
                        </select>
                    </div>
                    <!-- Minutes Input -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="minutes" class="form-label">Minutes Read</label>
                        <input type="number" class="form-control" id="minutes" name="minutes" min="1" max="10" value="<?php echo htmlspecialchars($articleData->minutes); ?>" required>
                    </div>

                    <!-- Slider Switch -->
                    <div style="flex: 1; max-width: 30%;" class="mx-2">
                        <label for="featured" class="form-label">Featured</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" <?php echo $articleData->featured ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="featured">Yes</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($articleData->title); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="summernote" name="content" rows="5" required><?php echo htmlspecialchars($articleData->content); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags (comma-separated)</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="<?php echo htmlspecialchars($articleData->tags); ?>">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <?php if (!empty($articleData->image)): ?>
                        <img src="<?php echo base_url($articleData->image); ?>" alt="Current Image" class="img-fluid mt-2" style="max-width: 200px;">
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
</div>