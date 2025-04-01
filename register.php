<?php include "./assets/includes/header.php";

?>

<div class="d-flex flex-column min-vh-100 bg-video">


    <!-- Background Video -->
    <video autoplay muted loop playsinline class="bg-video-element">
        <source src="./assets/videos/comingsoon.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <!-- Navbar -->
    <?php include 'assets/includes/navigation.php'; ?>

    <!-- Registration Section -->
    <!-- <main class="flex-grow-1 d-flex align-items-center justify-content-center mb-3">
        <div class="card shadow-lg border-0 rounded-lg p-4 login-card">
            <div class="card-header text-center">
                <h3 class="text-secondary">Sign Up</h3>
            </div>
            <div class="card-body">
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
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            name="confirmPassword"
                            id="confirmPassword"
                            class="form-control"
                            placeholder="Confirm your password"
                            required />
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
    </main> -->

    <!-- Footer -->
    <?php //include 'assets/includes/footer.php'; 
    ?>
</div>