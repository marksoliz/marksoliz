<?php


$article = new Article();
// Fetch published random articles using the getPublishedRandomArticles() method
$articles = $article->getRandomPublishedArticles(5);

$category = new Category();
// Fetch all categories using the getAllCategories() method

$categories = $category->getAllCategories();

?>

<div class="container">
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h2 class="section-title">Latest Articles</h2>
        </div>
        <?php if (!empty($articles)): ?>
            <!-- First Post -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="row">

                    <div class="col-12 mb-4">
                        <?php $firstArticle = array_shift($articles); // Get the first article 
                        ?>
                        <article class="card article-card">
                            <a href="<?php echo base_url('posts/article/' . htmlspecialchars($firstArticle->slug)); ?>">
                                <div class="card-image">
                                    <div class="post-info"> <span class="text-uppercase"><?php echo htmlspecialchars(date('d M Y', strtotime($firstArticle->created_at))); ?></span>
                                        <span class="text-uppercase"><?php echo htmlspecialchars($firstArticle->minutes); ?> minutes read</span>

                                    </div>
                                    <img loading="lazy" decoding="async" src="<?php echo file_exists(base_path($firstArticle->image)) ? base_url(htmlspecialchars($firstArticle->image)) : 'https://placehold.co/600x400?text=No+Image'; ?>" alt="Post Thumbnail" class="w-100">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-1">

                                <ul class="post-meta mb-2">
                                    <li>
                                        <strong>Category:</strong>
                                        <a href="#!"><?= htmlspecialchars($firstArticle->category_name); ?></a>
                                    </li>
                                    <li>
                                        <strong>Tags:</strong>
                                        <?php
                                        $tags = explode(',', $firstArticle->tags); // Split tags by comma
                                        foreach ($tags as $tag):
                                        ?>
                                            <a href="#!"><?php echo urlencode(trim($tag)); ?></a>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                                <h2 class="h1"><a class="post-title" href="<?php echo base_url('posts/article/' . htmlspecialchars($firstArticle->slug)); ?>"><?php echo htmlspecialchars($firstArticle->title); ?></a></h2>
                                <p class="card-text"><?php echo getExcerpt($firstArticle->content, 300); ?></p>
                                <div class="content"> <a class="read-more-btn" href="<?php echo base_url('posts/article/' . htmlspecialchars($firstArticle->slug)); ?>">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- Remaining Posts -->
                    <?php foreach ($articles as $article): ?>
                        <div class="col-md-6 mb-4">
                            <article class="card article-card article-card-sm h-100">
                                <a href="<?php echo base_url('posts/article/' . htmlspecialchars($article->slug)); ?>">
                                    <div class="card-image">
                                        <div class="post-info"> <span class="text-uppercase"><?php echo htmlspecialchars(date('d M Y', strtotime($article->created_at))); ?></span>
                                            <span class="text-uppercase"><?php echo htmlspecialchars($article->minutes); ?> minutes read</span>
                                        </div>
                                        <img loading="lazy" decoding="async" src="<?php echo file_exists(base_path($article->image)) ? base_url(htmlspecialchars($article->image)) : 'https://placehold.co/600x400?text=No+Image'; ?>" alt="Post Thumbnail" class="w-100">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-0">
                                    <ul class="post-meta mb-2">
                                        <li>
                                            <strong>Category:</strong>
                                            <a href="#!"><?= htmlspecialchars($article->category_name); ?></a>
                                        </li>
                                        <li>
                                            <strong>Tags:</strong>
                                            <?php
                                            $tags = explode(',', $article->tags); // Split tags by comma
                                            foreach ($tags as $tag):
                                            ?>
                                                <a href="#!"><?php echo urlencode(trim($tag)); ?></a>
                                            <?php endforeach; ?>
                                        </li>
                                    </ul>
                                    <h2><a class="post-title" href="<?php echo base_url('posts/article/' . htmlspecialchars($article->slug)); ?>"><?php echo htmlspecialchars($article->title); ?></a></h2>
                                    <p class="card-text"><?php echo getExcerpt($article->content, 300); ?></p>
                                    <div class="content"> <a class="read-more-btn" href="<?php echo base_url('posts/article/' . htmlspecialchars($article->slug)); ?>">Read Full Article</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>

                </div>
            </div>
            <div class="col-lg-4">
                <?php include base_path('assets/includes/widget-blocks.php') ?>
            </div>
    </div>
</div>