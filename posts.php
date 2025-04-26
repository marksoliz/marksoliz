<?php include "./assets/includes/header.php";

$article = new Article();


?>

<div class="d-flex flex-column min-vh-100 bg-image">
    <!-- Navbar -->
    <?php include 'assets/includes/navigation.php'; ?>

    <main class="flex-grow-1 d-flex align-items-center justify-content-center  mb-3">
        <div class="container-fluid shadow-lg border-0  p-4 blog-container">
            <!-- Blog Section -->
            <section id="blog" class="py-5 bg-light rounded-5">



                <?php
                $source = isset($_GET['source']) ? htmlspecialchars(trim($_GET['source'])) : '';


                $slug = isset($_GET['slug']) ? htmlspecialchars(trim($_GET['slug'])) : '';


                switch ($source) {
                    case 'viewCategories':
                        include 'blog/categories/';
                        break;

                    case 'article': // Check if the source is 'article'
                        if (!empty($slug)) {
                            // Include blog/article.php
                            include 'blog/article.php';
                        } else {
                            echo "No article slug provided.";
                        }
                        break;

                    default:
                        include 'blog/index.php';
                        break;
                }
                ?>



                <!-- # JS Plugins -->
                <script src="plugins/jquery/jquery.min.js"></script>
                <script src="plugins/bootstrap/bootstrap.min.js"></script>

                <!-- Main Script -->
                <script src="js/script.js"></script>




            </section>
        </div>
    </main>
    <!-- Footer -->
    <?php include 'assets/includes/footer.php';
    ?>
</div>