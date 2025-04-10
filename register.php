<?php include "./assets/includes/header.php";
//check if user is logged in
if (isUserLoggedIn()) {
    redirect('index.php');
}

// Function to check if the request method is POST
if (isPostRequest()) {

    $user = new User();


    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $errors = [];


    // Check if username already exists
    if ($user->userExists($username)) {
        $errors[] = "<div class='alert alert-danger'>Username already exists!</div>";
    }
    // Check if email already exists
    if ($user->emailExists($email)) {
        $errors[] = "<div class='alert alert-danger'>Email already exists!</div>";
    }
    // Validate passwords
    if ($password !== $confirmPassword) {
        $errors[] = "<div class='alert alert-danger'>Passwords do not match!</div>";
    } elseif (strlen($password) < 8) {
        $errors[] = "<div class='alert alert-danger'>Password must be at least 8 characters long!</div>";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "<div class='alert alert-danger'>Password must contain at least one uppercase letter!</div>";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $errors[] = "<div class='alert alert-danger'>Password must contain at least one lowercase letter!</div>";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors[] = "<div class='alert alert-danger'>Password must contain at least one number!</div>";
    } elseif (!preg_match('/[\W_]/', $password)) {
        $errors[] = "<div class='alert alert-danger'>Password must contain at least one special character!</div>";
    }

    if (empty($errors)) {
        // Proceed with registration logic (e.g., save to database)
        if ($user->register($firstName, $lastName, $username, $email, $password)) {
            // Registration successful
            redirect('login.php?success=1');
        } else {
            // Registration failed
            $errors[] = "<div class='alert alert-danger'>Registration failed. Please try again.</div>";
        }
    }
}
?>

<div class="d-flex flex-column min-vh-100 bg-image">
    <!-- Navbar -->
    <?php include 'assets/includes/navigation.php'; ?>

    <!-- Registration Section -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center mb-4">
        <div class="card shadow-lg border-0 rounded-lg p-4 login-card">
            <div class="card-header text-center">
                <h3 class="text-secondary">Sign Up</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="mb-3">
                        <?php foreach ($errors as $error): ?>
                            <?php echo $error; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input
                            type="text"
                            name="firstName"
                            id="firstName"
                            class="form-control"
                            placeholder="Enter your first name"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input
                            type="text"
                            name="lastName"
                            id="lastName"
                            class="form-control"
                            placeholder="Enter your last name"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            placeholder="Enter your email address"
                            required />
                    </div>
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
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                name="confirmPassword"
                                id="confirmPassword"
                                class="form-control"
                                placeholder="Confirm your password"
                                required />
                            <span class="input-group-text" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="small mb-0">Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'assets/includes/footer.php';
    ?>
</div>

<script>



</script>