<?php include "./assets/includes/header.php";
//check if user is logged in
if (isUserLoggedIn()) {
    redirect('index.php');
}
// check $_GET for success=1 message
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $successMessage = "<div class='alert alert-success'>Registration successful! You can now log in.</div>";
}

// check $_GET for error=1 message
if (isset($_GET['error']) && $_GET['error'] == 1) {
    $errorMessage = "<div class='alert alert-danger'>Error: Invalid username or password!</div>";
}


if (isPostRequest()) {
    // check if username and password are set
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Create a new User object
        $user = new User();

        // Check if the user exists and the password is correct
        if ($user->login($username, $password)) {
            // Redirect to the dashboard or home page
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                redirect('admin/index.php');
            } elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user') {
                redirect('index.php');
            } else {
                redirect('index.php');
            }
        } else {
            // redirect to login page echo error message
            redirect('login.php?error=1');
        }
    } else {
        $errors[] = "<div class='alert alert-danger'>Please enter your username and password!</div>";
    }
}
?>

<div class="d-flex flex-column min-vh-100 bg-image">
    <!-- Navbar -->
    <?php include 'assets/includes/navigation.php'; ?>

    <!-- Login Section -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg border-0 rounded-lg p-4 login-card mb-4">
            <div class="card-header text-center">
                <h3 class="text-secondary">Login</h3>
            </div>

            <div class="card-body">
                <?php if (isset($successMessage)) {
                    echo $successMessage;
                }

                if (isset($errorMessage)) {
                    echo $errorMessage;
                } ?>


                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="form-control"
                            placeholder="Enter your username"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required />
                            <span class="input-group-text" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="forgotPassword.php" class="small">Forgot Password?</a>
                        <button type="submit" class="btn btn-secondary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="small mb-0">Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'assets/includes/footer.php';
    ?>
</div>

<script>

</script>