<footer class="footer">
    <div class="container text-center">
        <p>© <span id="currentYear"></span> MarkSoliz.com All rights reserved.</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="index.php">Home</a></li>
            <li class="list-inline-item"><a href="index.php#about">About Mark Soliz Web Developer</a></li>
            <li class="list-inline-item"><a href="index.php#Services">Services</a></li>
            <li class="list-inline-item"><a href="index.php#contact">Contact</a></li>
            <li class="list-inline-item"><a href="portfolio.php">Portfolio</a></li>
            <li class="list-inline-item"><a href="blog.php">Blog</a></li>
        </ul>
    </div>
</footer>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script
    src="https://kit.fontawesome.com/542e489daa.js"
    crossorigin="anonymous"></script>
<script>
    // Back to Top Button
    const backToTopButton = document.getElementById("backToTop");

    // Show or hide the button based on scroll position
    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            backToTopButton.classList.add("show");
        } else {
            backToTopButton.classList.remove("show");
        }
    });

    // Scroll to the top when the button is clicked
    backToTopButton.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
</script>

<script>
    // Dynamically set the current year in the footer
    const currentYear = new Date().getFullYear();
    document.getElementById("currentYear").textContent = currentYear;
</script>

<!-- JavaScript to Control Video Playback Speed -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const video = document.getElementById("portfolioVideo");
        video.playbackRate = 0.2; // Set playback speed to 50% (slower)
    });
</script>

</body>

</html>