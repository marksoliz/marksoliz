<?php

// Include the necessary files
include "./includes/admin_header.php";

// Check if the user is logged in
// if (!checkUserLoggedIn()) {
//     redirect('login.php');
// }

// Check if the user is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect to the homepage or login page
    redirect('index.php');
    exit();
}
// Include the navigation
include "./includes/nav.php";

// Sanitize the input to prevent XSS attacks
// htmlspecialchars() converts special characters to HTML entities
// trim() removes whitespace from the beginning and end of a string
$source = isset($_GET['source']) ? htmlspecialchars(trim($_GET['source'])) : '';

?>

<!-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
  </ol>
</nav> -->


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Area</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">

                    <?php
                    switch ($source) {

                        case 'view_all_users';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active " aria-current="page">View All Users</li>';

                            break;


                        case 'add_user';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active " aria-current="page">Add User</li>';
                            break;

                        case 'contact_form';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Contact Form</li>
                        <li class="breadcrumb-item active " aria-current="page">View All Messages</li>';
                            break;

                        case 'view_edit_categories';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Categories</li>
                        <li class="breadcrumb-item active " aria-current="page">View/Edit Categories</li>';
                            break;

                        case 'view_all_posts';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active " aria-current="page">View All Posts</li>';
                            break;

                        case 'add_post';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active " aria-current="page">Add Post</li>';
                            break;

                        case 'view_all_comments';

                            echo '<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item">Pages</li>
                        <li class="breadcrumb-item">Blog</li>
                        <li class="breadcrumb-item active " aria-current="page">View All Comments</li>';
                            break;

                        default:

                            echo '<li class="breadcrumb-item active">Dashboard</li>';

                            break;
                    }
                    ?>

                </ol>
            </nav>
            <?php





            switch ($source) {

                case 'view_all_users';

                    include "includes/view_all_users.php";

                    break;


                case 'add_user';

                    include "includes/add_user.php";
                    break;

                case 'contact_form';

                    include "includes/contact_form.php";
                    break;

                case 'view_edit_categories';

                    include "includes/view_edit_categories.php";
                    break;

                case 'view_all_posts';

                    include "includes/view_all_posts.php";
                    break;

                case 'add_post';

                    include "includes/add_post.php";
                    break;

                case 'view_all_comments';

                    include "includes/view_all_comments.php";
                    break;

                default:

                    include "./includes/admin_dashboard.php";

                    break;
            }
            ?>
        </div>
    </main>
    <?php include "./includes/admin_footer.php"; ?>