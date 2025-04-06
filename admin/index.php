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



?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <?php


            // Sanitize the input to prevent XSS attacks
            // htmlspecialchars() converts special characters to HTML entities
            // trim() removes whitespace from the beginning and end of a string
            $source = isset($_GET['source']) ? htmlspecialchars(trim($_GET['source'])) : '';


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