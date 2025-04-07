<?php

include './partials/admin/header.php';
include './partials/admin/navbar.php';



//initialize article class
$article = new Article();

//get all articles by user id
$userId = $_SESSION['user_id'];
$userArticles = $article->getArticlesByUserId($userId);

//get username
$username = $_SESSION['username'];

?>

<!-- Main Content -->
<main class="container my-5 main">
    <h2 class="mb-4">Welcome <?php echo $username; ?> to your Admin Dashboard</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <!-- Dummy Data Button -->
        <form action="create-dummy-articles.php" method="post" class="d-flex align-items-center">
            <label class="me-2" for="articleCount">Number of Articles:</label>
            <input style="width: 100px" type="number" name="articleCount" id="articleCount" class="form-control me-2" value="5" min="1" max="100">
            <button id="articleCount" class="btn btn-primary btn-rounded-pill" type="submit">Generate Dummy Articles</button>
        </form>

        <form action="" method="post" class="">
            <button class="btn btn-warning btn-rounded-pill" type="submit">Generate Articles</button>
        </form>

        <button class="btn btn-danger btn-rounded-pill">Delete Selected Articles</button>
    </div>
    <!-- Articles Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Excerpt</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($userArticles)):  ?>
                    <?php foreach ($userArticles as $articleItem): ?>
                        <!-- Example Article Row -->
                        <tr>
                            <td><?php echo $articleItem->id; ?></td>
                            <td><?php echo $articleItem->title; ?></td>
                            <td><?php echo $_SESSION['username']; ?></td>
                            <td><?php echo formatDate($articleItem->created_at); ?></td>
                            <td>
                                <?php echo $article->getExcerpt($articleItem->content); ?>
                            </td>
                            <td>

                                <a href="edit-article.php?id=<?php echo $articleItem->id; ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                            </td>
                            <td>
                                <form onsubmit="confirmDelete(<?php echo $articleItem->id; ?>)" method="post" action="<?php echo base_url("delete-article.php"); ?>">
                                    <input type="hidden" name="article_id" value="<?php echo $articleItem->id; ?>">
                                    <input type="hidden" name="article_image" value="<?php echo $articleItem->image; ?>">

                                    <button class="btn btn-sm btn-danger">Delete</button>
                                    <!-- <button class="btn btn-sm btn-danger" onclick="confirmDelete(1)">Delete</button> -->
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>
</main>

<?php include './partials/admin/footer.php'; ?>