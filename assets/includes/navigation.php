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
            src="./assets/images/mark-soliz-web-desing-hosting-digital-marketing.jpg"
            alt="Mark Soliz" />
        <a class="navbar-brand fw-bold" href="index.php">MarkSoliz.com</a>
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
                    <a class="nav-link rounded-pill px-3 py-2" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="index.php#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="index.php#Services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="index.php#contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="portfolio.php">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill px-3 py-2" href="blog.php">Blog</a>
                </li>
            </ul>
            <!-- Search Field -->
            <form class="d-flex ms-3">
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control rounded-pill"
                        placeholder="Search"
                        aria-label="Search" />
                    <span class="input-group-text bg-transparent border-0">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            </form>
        </div>
    </div>
</nav>