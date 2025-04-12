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
            <button name="reorder_users" class="btn btn-warning btn-rounded-pill" type="submit">Reorder Users</button>
        </form>
    </div>
    <table class="table table-striped table-hover table-bordered table-responsive">
        <thead class="table-dark">
            <tr>
                <th>
                    <input type="checkbox" id="selectAllUserCheckbox" />
                </th>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date Joined</th>
                <th>Role</th>
                <th>Edit User</th>
                <th>Delete User</th>
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
                            <a href="<?php echo base_url('admin/index.php?source=edit_user&user_id=' . $user->id); ?>" class="btn btn-primary">Edit</a>
                        <td>
                            <form onsubmit="return confirmDeleteUser(<?php echo $user->id; ?>)" method="post" action="<?php echo base_url('admin/delete-user.php'); ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
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
                    <a class="page-link" href="?source=view_all_users&page=<?= $currentPage - 1 ?>" aria-label="Previous">
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
                    <a class="page-link" href="?source=view_all_users&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?source=view_all_users&page=<?= $currentPage + 1 ?>" aria-label="Next">
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
        const selectAllCheckbox = document.getElementById('selectAllUserCheckbox');
        const userCheckboxes = document.querySelectorAll('.userCheckbox');

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
    document.getElementById('deleteSelectedUserBtn').onclick = function() {
        let selectIDs = [];
        let checkboxes = document.querySelectorAll('.userCheckbox:checked');

        checkboxes.forEach((checkbox) => {
            selectIDs.push(checkbox.value);
        });

        console.log("Selected IDs:", selectIDs); // Debugging line

        if (selectIDs.length === 0) {
            alert("Please select at least one user to delete.");
            return;
        }

        if (confirm("Are you sure you want to delete the selected user/users?")) {
            sendUserDeleteRequest(selectIDs);
        }
    }

    // Function to send delete using ajax
    function sendUserDeleteRequest(userIds) {

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo base_url('admin/delete-selected-users.php'); ?>", true);
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