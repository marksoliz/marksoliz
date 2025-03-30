<?php include './assets/includes/header.php'; ?>
<!-- Navigation -->
<div class="bg-video-portfolio">
  <video autoplay muted loop playsinline class="bg-video">
    <source src="./assets/videos/myportfolio.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>
  <?php include './assets/includes/navigation.php'; ?>
</div>

<!-- Portfolio Section -->
<section id="portfolio" class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title text-center mb-4">My Portfolio</h2>
    <p class="text-center lead mb-5">
      Explore some of the websites and projects I’ve created, showcasing my skills in web development, design, and creativity.
    </p>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <!-- Project 1 -->
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img
            src="https://placehold.co/600x400"
            class="card-img-top"
            alt="Project 1" />
          <div class="card-body">
            <h5 class="card-title">TinDog</h5>
            <p class="card-text">
              A mock dating app for dogs built with HTML, CSS, and Bootstrap. This project demonstrates responsive design and creative layouts.
            </p>
          </div>
          <div class="card-footer text-center">
            <a
              href="https://marksoliz.github.io/BasicHtmlResume/11.3%20TinDog%20Project/"
              class="btn btn-primary"
              target="_blank">View Project</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include './assets/includes/footer.php'; ?>