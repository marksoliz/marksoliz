<?php

if (isset($_GET['slug'])) {
    $slug = htmlspecialchars($_GET['slug']);
    $article = $article->getArticleBySlug($slug);

    if (!$article) {
        // Handle 404 error if the article is not found
        // header("HTTP/1.0 404 Not Found");
        echo "Article not found.";
        exit;
    }
} else {
    // Handle invalid access
    // header("HTTP/1.0 400 Bad Request");
    echo "Invalid request.";
    exit;
}

// Display the article
?>
<div class="container">
    <!-- Article Image -->
    <?php if (!empty($article->image)): ?>
        <div class="article-image text-center mb-4">
            <img src="<?php echo base_url(htmlspecialchars($article->image)); ?>" alt="<?php echo htmlspecialchars($article->title); ?>" class="img-fluid">
        </div>
    <?php endif; ?>

    <!-- Article Title -->
    <h1 class="article-title"><?php echo htmlspecialchars($article->title); ?></h1>

    <!-- Article Content -->
    <div class="article-content">
        <?php echo $article->content; ?>
    </div>

    <!-- Article Tags -->
    <?php if (!empty($article->tags)): ?>
        <div class="article-tags">
            <strong>Tags:</strong>
            <?php
            $tags = explode(',', $article->tags); // Assuming tags are comma-separated
            foreach ($tags as $tag) {
                echo '<span class="badge bg-secondary">' . htmlspecialchars(trim($tag)) . '</span> ';
            }
            ?>
        </div>
    <?php endif; ?>
</div>