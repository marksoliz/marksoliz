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
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                <?php foreach ($articles as $article): ?>
                    <div class="col-12 mb-4">
                        <article class="card article-card">
                            <a href="<?php echo base_url('posts/article/' . htmlspecialchars($article->slug)); ?>">
                                <div class="card-image">
                                    <div class="post-info"> <span class="text-uppercase"><?php echo htmlspecialchars(date('d M Y', strtotime($article->created_at))); ?></span>
                                        <span class="text-uppercase"><?php echo htmlspecialchars($article->minutes); ?> minutes read</span>

                                    </div>
                                    <img loading="lazy" decoding="async" src="<?php echo file_exists(base_path($article->image)) ? base_url(htmlspecialchars($article->image)) : 'https://placehold.co/600x400?text=No+Image'; ?>" alt="Post Thumbnail" class="w-100">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-1">

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
                                <h2 class="h1"><a class="post-title" href="article.php?id=<?php echo htmlspecialchars($article->id); ?>"><?php echo htmlspecialchars($article->title); ?></a></h2>
                                <p class="card-text"><?php echo getExcerpt($article->content, 300); ?></p>
                                <div class="content"> <a class="read-more-btn" href="article.php?id=<?= htmlspecialchars($article->id); ?>">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="article.php?id=<?php echo htmlspecialchars($article->id); ?>">
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
                                <h2><a class="post-title" href="article.php?id=<?php echo htmlspecialchars($article->id); ?>"><?php echo htmlspecialchars($article->title); ?></a></h2>
                                <p class="card-text"><?php echo getExcerpt($article->content, 300); ?></p>
                                <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="article.php?id=<?php echo htmlspecialchars($article->id); ?>">
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
                                <h2><a class="post-title" href="article.php?id=<?php echo htmlspecialchars($article->id); ?>"><?php echo htmlspecialchars($article->title); ?></a></h2>
                                <p class="card-text"><?php echo getExcerpt($article->content, 300); ?></p>
                                <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="article.php?id=<?php echo htmlspecialchars($article->id); ?>">
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
                                <h2><a class="post-title" href="article.php?id=<?php echo htmlspecialchars($article->id); ?>"><?php echo htmlspecialchars($article->title); ?></a></h2>
                                <p class="card-text"><?php echo getExcerpt($article->content, 300); ?></p>
                                <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="article.php?id=<?php echo htmlspecialchars($article->id); ?>">
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
                                <h2><a class="post-title" href="article.php?id=<?php echo htmlspecialchars($article->id); ?>"><?php echo htmlspecialchars($article->title); ?></a></h2>
                                <p class="card-text"><?php echo getExcerpt($article->content, 300); ?></p>
                                <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget-blocks">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="widget">
                            <h2 class="section-title mb-3">Featured</h2>
                            <div class="widget-body">
                                <article class="card mb-4">
                                    <div class="card-image">
                                        <div class="post-info"> <span class="text-uppercase">1 minutes read</span>
                                        </div>
                                        <img loading="lazy" decoding="async" src="/assets/blogImages/post/post-9.jpg" alt="Post Thumbnail" class="w-100">
                                    </div>
                                    <div class="card-body px-0 pb-1">
                                        <h3><a class="post-title post-title-sm"
                                                href="article.html">Portugal and France Now
                                                Allow Unvaccinated Tourists</a></h3>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor …</p>
                                        <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Recommended</h2>
                            <div class="widget-body">
                                <div class="widget-list">
                                    <article class="card mb-4">
                                        <div class="card-image">
                                            <div class="post-info"> <span class="text-uppercase">1 minutes read</span>
                                            </div>
                                            <img loading="lazy" decoding="async" src="/assets/blogImages/post/post-9.jpg" alt="Post Thumbnail" class="w-100">
                                        </div>
                                        <div class="card-body px-0 pb-1">
                                            <h3><a class="post-title post-title-sm"
                                                    href="article.html">Portugal and France Now
                                                    Allow Unvaccinated Tourists</a></h3>
                                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor …</p>
                                            <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                                            </div>
                                        </div>
                                    </article>
                                    <a class="media align-items-center" href="article.html">
                                        <img loading="lazy" decoding="async" src="/assets/blogImages/post/post-2.jpg" alt="Post Thumbnail" class="w-100">
                                        <div class="media-body ml-3">
                                            <h3 style="margin-top:-5px">These Are Making It Easier To Visit</h3>
                                            <p class="mb-0 small">Heading Here is example of hedings. You can use …</p>
                                        </div>
                                    </a>
                                    <a class="media align-items-center" href="article.html"> <span class="image-fallback image-fallback-xs">No Image Specified</span>
                                        <div class="media-body ml-3">
                                            <h3 style="margin-top:-5px">No Image specified</h3>
                                            <p class="mb-0 small">Lorem ipsum dolor sit amet, consectetur adipiscing …</p>
                                        </div>
                                    </a>
                                    <a class="media align-items-center" href="article.html">
                                        <img loading="lazy" decoding="async" src="/assets/blogImages/post/post-5.jpg" alt="Post Thumbnail" class="w-100">
                                        <div class="media-body ml-3">
                                            <h3 style="margin-top:-5px">Perfect For Fashion</h3>
                                            <p class="mb-0 small">Lorem ipsum dolor sit amet, consectetur adipiscing …</p>
                                        </div>
                                    </a>
                                    <a class="media align-items-center" href="article.html">
                                        <img loading="lazy" decoding="async" src="/assets/blogImages/post/post-9.jpg" alt="Post Thumbnail" class="w-100">
                                        <div class="media-body ml-3">
                                            <h3 style="margin-top:-5px">Record Utra Smooth Video</h3>
                                            <p class="mb-0 small">Lorem ipsum dolor sit amet, consectetur adipiscing …</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="widget">
                            <h2 class="section-title mb-3">Categories</h2>
                            <div class="widget-body">
                                <ul class="widget-list">

                                    <?php


                                    // Loop through the categories and display them as options
                                    foreach ($categories as $cat) {
                                        // Fetch the number of articles for the current category
                                        $articleCount = $category->getArticleCountByCategoryId($cat->id);
                                        echo '<li><a href="?source=viewCategories&id=' . $cat->id . '">' . $cat->name . '<span class="ml-auto">(' . $articleCount . ')</span></a>
                                                    </li>';
                                    }
                                    ?>



                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>