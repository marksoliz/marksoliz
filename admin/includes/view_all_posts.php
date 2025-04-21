<?php
// Get all messages from contact form
$article = new Article();

// Pagination logic
$perPage = 10; // Messages per page
$totalArticles = count($article->getArticles());
$totalPages = ceil($totalArticles / $perPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));
$offset = ($currentPage - 1) * $perPage;

$articles = $article->getArticles($offset, $perPage);
?>

<div class="container">
    <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
        <button id="deleteSelectedArticleBtn" class="btn btn-danger btn-rounded-pill my-2">Delete Selected Articles</button>

        <!-- Dummy Data Button -->
        <form action="<?php echo base_url('admin/create-dummy-articles.php') ?>" method="post" class="d-flex align-items-center">
            <label class="form-label me-2" for="articleCount">Number of Articles:</label>
            <input style="width: 100px" type="number" name="articleCount" id="articleCount" class="form-control me-2" value="" min="1" max="100">
            <button id="articleCount" class="btn btn-primary btn-rounded-pill" type="submit">Generate Dummy Aticles</button>
        </form>

        <form action="<?php echo base_url('admin/reorder-articles.php') ?>" method="post" class="">
            <button name="reorder_articles" class="btn btn-warning btn-rounded-pill" type="submit">Reorder Articles</button>
        </form>
    </div>
    <table class="table table-striped table-hover table-bordered table-responsive">
        <thead class="table-dark">
            <tr>
                <th>
                    <input type="checkbox" id="selectAllPostCheckbox" />
                </th>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>
            <?php if ($articles): ?>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="articleCheckbox" value="<?= htmlspecialchars($article->id) ?>" />
                        </td>
                        <td><?= htmlspecialchars($article->id) ?></td>
                        <td><?= htmlspecialchars($article->title) ?></td>
                        <td><?= htmlspecialchars(getExcerpt($article->content)); ?></td>
                        <td><img src="<?php echo base_url(htmlspecialchars($article->image)); ?>" alt="Post Image" class="img-fluid" style="max-width: 100px;"></td>
                        <td><?= htmlspecialchars($article->status) ?></td>
                        <td><?= htmlspecialchars(date('F j, Y', strtotime($article->created_at))) ?></td>
                        <td><?= htmlspecialchars(date('F j, Y', strtotime($article->updated_at))) ?></td>
                        <td><?= htmlspecialchars($article->category_name) ?></td>
                        <td><?= htmlspecialchars($article->tags) ?></td>
                        <td>
                            <a href="index.php?source=edit_post&post_id=<?php echo $article->id ?>" class="btn btn-primary">Edit</a>
                        <td>
                            <form onsubmit="return confirmDeletePost(<?php echo $article->id; ?>)" method="post" action="<?php echo base_url('admin/delete-article.php'); ?>">
                                <input type="hidden" name="article_id" value="<?php echo $article->id; ?>">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($currentPage > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?source=view_all_posts&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);
            for ($i = $startPage; $i <= $endPage; $i++):
            ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link" href="?source=view_all_posts&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?source=view_all_posts&page=<?= $currentPage + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script>
    // Select / Deselect all checkboxes for users
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAllPostCheckbox');
        const userCheckboxes = document.querySelectorAll('.articleCheckbox');

        // Add event listener to the "Select All" checkbox
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = selectAllCheckbox.checked;

            // Set the checked state of all user checkboxes
            userCheckboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
        });

        // Optional: Update "Select All" checkbox state if individual checkboxes are toggled
        userCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false; // Uncheck "Select All" if any checkbox is unchecked
                } else if (Array.from(userCheckboxes).every(cb => cb.checked)) {
                    selectAllCheckbox.checked = true; // Check "Select All" if all checkboxes are checked
                }
            });
        });
    });

    // Delete selected Users
    document.getElementById('deleteSelectedArticleBtn').onclick = function() {
        let selectIDs = [];
        let checkboxes = document.querySelectorAll('.articleCheckbox:checked');

        checkboxes.forEach((checkbox) => {
            selectIDs.push(checkbox.value);
        });

        console.log("Selected IDs:", selectIDs); // Debugging line

        if (selectIDs.length === 0) {
            alert("Please select at least one post to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected post/posts?")) {
            sendArticleDeleteRequest(selectIDs);
        }
    }

    // Function to send delete using ajax
    function sendArticleDeleteRequest(articleIds) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url('admin/delete-articles.php'); ?>", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from the server
                let response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert("Users deleted successfully!");
                    location.reload(); // Reload the page to see the changes
                } else {
                    alert("Error deleting user: " + response.message);
                }
            }
        };
        xhr.send(JSON.stringify({
            user_ids: userIds
        }));
    }
</script>