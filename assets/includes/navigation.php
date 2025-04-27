<?php
// Determine the current file name
$currentFile = basename($_SERVER['PHP_SELF']);
$isIndex = ($currentFile === 'index.php');
?>

<nav class="navbar navbar-expand-lg my-4 mx-5">
    <div class="container-fluid">
        <img
            class="img-fluid rounded-circle me-2"
            style="width: 50px; height: 50px"
            src="<?php echo base_url("assets/images/mark-soliz-web-desing-hosting-digital-marketing.jpg") ?>"
            alt="Mark Soliz" />
        <a class="navbar-brand fw-bold" href="<?php echo base_url("/") ?>">MarkSoliz.com</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("/") ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("#about") ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("#Services") ?>">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("#contact") ?>">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("portfolio/") ?>">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("posts/") ?>">Blog</a>
                </li>
                <?php if (!isUserLoggedIn()): ?>

                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("login/") ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("register/") ?>">Register</a>
                    </li>
                <?php else: ?>

                    <form method="POST" action="<?php echo base_url("logout.php") ?>">
                        <li class="nav-item">
                            <button type="submit" class="nav-link rounded-pill px-3 py-2">Logout</button>
                        </li>
                    </form>


                <?php endif; ?>

                <?php if (isUserLoggedIn() && isset($_SESSION['user_role']) == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill px-3 py-2" href="<?php echo base_url("admin") ?>">Admin</a>
                    </li>
                <?php endif; ?>
            </ul>
            <!-- Search Field -->
            <form class="d-flex ms-3">
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control rounded-pill"
                        placeholder="Search"
                        aria-label="Search"
                        disabled />
                    <span class="input-group-text bg-transparent border-0">
                        <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                    </span>
                </div>
            </form>
        </div>
    </div>
</nav>