<?php

$user = new User();
$error;
$message;

// Get the user ID from the query string
$userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

// Fetch user details
$userData = $user->getUserById($userId);

if (!$userData) {
    $error = "<div class='alert alert-danger'>User not found.</div>";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    // Update user information
    if ($user->updateUser($userId, $firstName, $lastName, $username, $email, $password, $role)) {
        $message = "<div class='alert alert-success'>User updated successfully!</div>";
    } else {
        $error = "<div class='alert alert-danger'>Failed to update user. Please try again.</div>";
    }

    // Refresh user data after update
    $userData = $user->getUserById($userId);
}
?>

<div class="container mt-4">
    <h2>Edit User</h2>
    <?php if (isset($message)) echo $message;
    else if (isset($error)) echo $error; ?>
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Adjust the width using Bootstrap's grid system -->

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($userData->firstName) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($userData->lastName) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($userData->username) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userData->email) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="admin" <?= $userData->user_role === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="editor" <?= $userData->user_role === 'editor' ? 'selected' : '' ?>>Editor</option>
                        <option value="subscriber" <?= $userData->user_role === 'subscriber' ? 'selected' : '' ?>>Subscriber</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>