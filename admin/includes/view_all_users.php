<?php
// Get all messages from contact form
$user = new User();

// Pagination logic
$perPage = 10; // Messages per page
$totalUsers = count($user->getAllUsers());
$totalPages = ceil($totalUsers / $perPage);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));
$offset = ($currentPage - 1) * $perPage;

$users = $user->getAllUsers($offset, $perPage);
?>

<div class="container">
    <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
        <button id="deleteSelectedUserBtn" class="btn btn-danger btn-rounded-pill my-2">Delete Selected Users</button>

        <!-- Dummy Data Button -->
        <form action="<?php echo base_url('admin/create-dummy-users.php') ?>" method="post" class="d-flex align-items-center">
            <label class="form-label me-2" for="userCount">Number of Users:</label>
            <input style="width: 100px" type="number" name="userCount" id="userCount" class="form-control me-2" value="" min="1" max="100">
            <button id="userCount" class="btn btn-primary btn-rounded-pill" type="submit">Generate Dummy Users</button>
        </form>

        <form action="<?php echo base_url('admin/reorder-users.php') ?>" method="post" class="">
            <button name="reorder_articles" class="btn btn-warning btn-rounded-pill" type="submit">Reorder Article ID's</button>
        </form>
    </div>
    <table class="table table-striped table-hover table-bordered table-responsive">
        <thead class="table-dark">
            <tr>
                <th>
                    <input type="checkbox" id="selectAllCheckbox" />
                </th>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date Joined</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($users): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="userCheckbox" value="<?= htmlspecialchars($user->id) ?>" />
                        </td>
                        <td><?= htmlspecialchars($user->id) ?></td>
                        <td><?= htmlspecialchars($user->username) ?></td>
                        <td><?= htmlspecialchars($user->email) ?></td>
                        <td><?= htmlspecialchars($user->firstName) ?></td>
                        <td><?= htmlspecialchars($user->lastName) ?></td>
                        <td><?= htmlspecialchars(date('F j, Y', strtotime($user->created_at))) ?></td>
                        <td><?= htmlspecialchars($user->user_role) ?></td>
                        <td>
                            <form onsubmit="return confirmDeleteMessage(<?php echo $user->id; ?>)" method="post" action="<?php echo base_url('admin/delete-user.php'); ?>">
                                <input type="hidden" name="message_id" value="<?php echo $user->id; ?>">
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
                    <a class="page-link" href="?source=contact_form&page=<?= $currentPage - 1 ?>" aria-label="Previous">
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
                    <a class="page-link" href="?source=contact_form&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?source=contact_form&page=<?= $currentPage + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>