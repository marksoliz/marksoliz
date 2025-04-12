<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // User role

    // Add User
    $addUser = new User();

    // Register the user
    if ($addUser->register($firstName, $lastName, $username, $email, $password)) {
        // Redirect or show success message
        $message = "<div class='alert alert-success'>User added successfully!</div>";
    } else {
        // Show error message
        $error = "<div class='alert alert-danger'>Failed to add user. Please try again.</div>";
    }
}
?>

<div class="container-fluid mt-4">
    <h2>Add New User</h2>
    <?php if (isset($message)) echo $message;
    else if (isset($error)) echo $error; ?>
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Adjust the width using Bootstrap's grid system -->
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="subscriber">Subscriber</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Add User</button>
            </form>
        </div>
    </div>
</div>