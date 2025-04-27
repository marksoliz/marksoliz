<?php

if (isset($_GET['slug'])) {
    $slug = htmlspecialchars($_GET['slug']);
    $articleData = $article->getArticleBySlug($slug); // Fetch the article data

    if (!$articleData) {
        // Handle 404 error if the article is not found
        echo "Article not found.";
        exit;
    }

    // Fetch next and previous articles using the Article class
    $nextArticle = $article->getNextArticle($articleData->id); // Pass the current article ID
    $previousArticle = $article->getPreviousArticle($articleData->id); // Pass the current article ID
} else {
    // Handle invalid access
    echo "Invalid request.";
    exit;
}

// Display the article
?>
<div class="container">
    <div class="row no-gutters-lg">
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                <!-- Article Image -->
                <?php if (!empty($articleData->image)): ?>
                    <div class="article-image text-center mb-4">
                        <img src="<?php echo base_url(htmlspecialchars($articleData->image)); ?>" alt="<?php echo htmlspecialchars($articleData->title); ?>" class="img-fluid">
                    </div>
                <?php endif; ?>

                <!-- Article Title -->
                <h1 class="article-title"><?php echo htmlspecialchars($articleData->title); ?></h1>

                <!-- Article Content -->
                <div class="article-content">
                    <?php echo $articleData->content; ?>
                </div>

                <!-- Article Tags -->
                <?php if (!empty($articleData->tags)): ?>
                    <div class="article-tags">
                        <strong>Tags:</strong>
                        <?php
                        $tags = explode(',', $articleData->tags); // Assuming tags are comma-separated
                        foreach ($tags as $tag) {
                            echo '<span class="badge bg-secondary">' . htmlspecialchars(trim($tag)) . '</span> ';
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Comments Section -->

            <?php include base_path('assets/includes/comments.php'); ?>

            <!-- End Comments Section -->
        </div>

        <!-- start widget box -->
        <div class="col-lg-4">
            <?php include base_path('assets/includes/widget-blocks.php') ?>
        </div>
        <!-- End widget box -->
        <!-- Next and Previous Article Links -->
        <div class="article-navigation mt-4">
            <?php if ($previousArticle): ?>
                <a href="<?php echo base_url('posts/article/' . htmlspecialchars($previousArticle->slug)); ?>" class="btn btn-outline-primary">Previous: <?php echo htmlspecialchars($previousArticle->title); ?></a>
            <?php endif; ?>

            <?php if ($nextArticle): ?>
                <a href="<?php echo base_url('posts/article/' . htmlspecialchars($nextArticle->slug)); ?>" class="btn btn-outline-primary float-end">Next: <?php echo htmlspecialchars($nextArticle->title); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>