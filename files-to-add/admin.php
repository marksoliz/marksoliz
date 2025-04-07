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
        <form action="<?php echo base_url('create-dummy-articles.php') ?>" method="post" class="d-flex align-items-center">
            <label class="form-label me-2" for="articleCount">Number of Articles:</label>
            <input style="width: 100px" type="number" name="articleCount" id="articleCount" class="form-control me-2" value="" min="1" max="100">
            <button id="articleCount" class="btn btn-primary btn-rounded-pill" type="submit">Generate Dummy Articles</button>
        </form>

        <form action="<?php echo base_url('reorder-articles.php') ?>" method="post" class="">
            <button name="reorder_articles" class="btn btn-warning btn-rounded-pill" type="submit">Reoder Article ID's</button>
        </form>

        <button id="deleteSelectedBtn" class="btn btn-danger btn-rounded-pill">Delete Selected Articles</button>
    </div>
    <!-- Articles Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th><input type="checkbox" id="selectAllCheckbox"></th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Excerpt</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Ajax Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($userArticles)):  ?>
                    <?php foreach ($userArticles as $articleItem): ?>
                        <!-- Example Article Row -->
                        <tr>
                            <td><input type="checkbox" class="articleCheckbox" value="<?php echo $articleItem->id; ?>"></td>
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
                            <td>
                                <button data-id="<?php echo $articleItem->id; ?>" class="btn btn-sm btn-danger delete-single">ajaxdelete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


            </tbody>
        </table>
    </div>
</main>
<script>
    // Select / Deselect all checkboxes
    document.getElementById('selectAllCheckbox').onclick = function() {
        let checkboxes = document.querySelectorAll('.articleCheckbox');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };

    // Delete selected articles
    document.getElementById('deleteSelectedBtn').onclick = function() {
        let selectIDs = [];
        let checkboxes = document.querySelectorAll('.articleCheckbox:checked');

        checkboxes.forEach((checkbox) => {
            selectIDs.push(checkbox.value);
        });

        if (selectIDs.length === 0) {
            alert("Please select at least one article to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected articles?")) {
            sendDeleteRequest(selectIDs);
        }


    };

    // Delete single article with ajax
    document.querySelectorAll('.delete-single').forEach((button) => {
        button.onclick = function() {
            let articleId = this.getAttribute('data-id');
            if (confirm("Are you sure you want to delete this articles? Article ID: " + articleId)) {
                // Send AJAX request to delete the article
                sendDeleteRequest([articleId]);
            }
        };
    });

    // Function to send delete using ajax
    function sendDeleteRequest(articleIds) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url('delete-articles.php'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Articles deleted successfully!");
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert("Error deleting articles: " + response.message);
                }
            }
        };
        xhr.send(JSON.stringify({
            article_ids: articleIds
        }));
    }
</script>
<?php include './partials/admin/footer.php'; ?>