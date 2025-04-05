<?php include "./assets/includes/header.php";

?>

<div class="d-flex flex-column min-vh-100 bg-image">
  <!-- Navbar -->
  <?php include 'assets/includes/navigation.php'; ?>


  <main class="flex-grow-1 d-flex align-items-center justify-content-center  mb-3">
    <div class="container-fluid shadow-lg border-0  p-4 portfolio-card">
      <!-- Portfolio Section -->
      <section id="portfolio" class="py-5 bg-light rounded-5">
        <div class="container border-0 rounded">
          <h2 class="section-title text-center mb-4">My Portfolio</h2>
          <p class="text-center lead mb-5">
            Explore some of the websites and projects I’ve created, showcasing my skills in web development, design, and creativity. The first few projects are personal projects that I created while learning HTML and CSS. The last two projects are live projects that I created, showcasing my ability to create dynamic and user-friendly web applications.
          </p>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Project 1 -->
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img
                  src="./assets/images/LaosFlag.png"
                  class="card-img-top"
                  alt="Project 1" />
                <div class="card-body">
                  <h5 class="card-title">Flag of Laos Project</h5>
                  <p class="card-text">
                    One of my very first projects while learning HTML and CSS. This project recreates the flag of Laos using only HTML and CSS, showcasing the basics of web development and design.

                  </p>
                </div>
                <div class="card-footer text-center">
                  <a
                    href="CSS Flag Project/"
                    class="btn btn-secondary"
                    target="_blank">View Project</a>
                </div>
              </div>
            </div>
            <!-- End Project 1 -->

            <!-- Project 2 -->
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img
                  src="./assets/images/guessNumber.png"
                  class="card-img-top"
                  alt="Project 2" />
                <div class="card-body">
                  <h5 class="card-title">Guess My Number Project</h5>
                  <p class="card-text">
                    A fun and interactive number guessing game built with JavaScript and HTML. This project showcases dynamic DOM manipulation and user interaction.

                  </p>
                </div>
                <div class="card-footer text-center">
                  <a
                    href="guessNumber/"
                    class="btn btn-secondary"
                    target="_blank">View Project</a>
                </div>
              </div>
            </div>
            <!-- End Project 2 -->
            <!-- Project 3 -->
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img
                  src="./assets/images/mondrainPorject.png"
                  class="card-img-top"
                  alt="Project 3" />
                <div class="card-body">
                  <h5 class="card-title">Mondrain Project</h5>
                  <p class="card-text">
                    A visually striking project inspired by the works of Piet Mondrian, created entirely with HTML and CSS. This project demonstrates the use of grid layouts and precise styling to replicate artistic designs.

                  </p>
                </div>
                <div class="card-footer text-center">
                  <a
                    href="Mondrian Project/"
                    class="btn btn-secondary"
                    target="_blank">View Project</a>
                </div>
              </div>
            </div>
            <!-- End Project 3 -->
            <!-- Project 4 -->
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img
                  src="./assets/images/tindog.png"
                  class="card-img-top"
                  alt="Project 4" />
                <div class="card-body">
                  <h5 class="card-title">TinDog</h5>
                  <p class="card-text">
                    A mock dating app for dogs built with HTML, CSS, and Bootstrap. This project demonstrates responsive design and creative layouts.
                  </p>
                </div>
                <div class="card-footer text-center">
                  <a
                    href="TinDog/"
                    class="btn btn-secondary"
                    target="_blank">View Project</a>
                </div>
              </div>
            </div>
            <!-- End Project 4 -->
            <!-- Project 5 -->
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img
                  src="./assets/images/happyfatgirl.png"
                  class=" card-img-top"
                  alt="Project 5" />
                <div class="card-body">
                  <h5 class="card-title">Happy Fat Girl Food Blog</h5>
                  <p class="card-text">
                    My first live project for the Happy Fat Girl Food Blog. This project was built using HTML, CSS, PHP, JavaScript, and AJAX to create a dynamic and interactive user experience.
                    This project showcases my skills in web development and design, as well as my ability to create a user-friendly interface.
                  </p>
                </div>
                <div class="card-footer text-center">
                  <a
                    href="https://happyfatgirl.com/"
                    class="btn btn-secondary"
                    target="_blank">View Project</a>
                </div>
              </div>
            </div>
            <!-- End Project 5 -->
            <!-- Project 6 -->
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img
                  src="./assets/images/marksoliz.com.png"
                  class=" card-img-top"
                  alt="Project 6" />
                <div class="card-body">
                  <h5 class="card-title">MarkSoliz.com</h5>
                  <p class="card-text">
                    MarkSoliz.com is a complete content management system built using HTML, CSS, JavaScript, and PHP. This project showcases my ability to create dynamic, scalable, and user-friendly web applications.
                    This project includes a blog, portfolio, and contact form, all designed to provide a seamless user experience.
                  </p>
                </div>
                <div class="card-footer text-center">
                  <a
                    href="https://marksoliz.com/"
                    class="btn btn-secondary"
                    target="_blank">View Project</a>
                </div>
              </div>
            </div>
            <!-- End Project 6 -->
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'assets/includes/footer.php'; ?>
</div>