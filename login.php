<?php include "./assets/includes/header.php";
// if (isPostRequest()) {
//     var_dump($_POST);
// }
?>

<div class="d-flex flex-column min-vh-100 bg-video">
    <!-- Navbar -->
    <?php include 'assets/includes/navigation.php'; ?>
    <video autoplay muted loop playsinline class="bg-video-element">
        <source src="./assets/videos/comingsoon.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <!-- Login Section -->
    <!-- <main class="flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="card shadow-lg border-0 rounded-lg p-4 login-card">
            <div class="card-header text-center">
                <h3 class="text-secondary">Login</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="">
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
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required />
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
    </main> -->

    <!-- Footer -->
    <?php //include 'assets/includes/footer.php'; 
    ?>
</div>