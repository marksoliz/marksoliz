<footer class="footer">
    <div class="container text-center">
        <p>© <span id="currentYear"></span> MarkSoliz.com All rights reserved.</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="<?php echo base_url("index.php") ?>">Home</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("index.php#about") ?>">About Mark Soliz Web Developer</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("index.php#Services") ?>">Services</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("index.php#contact") ?>">Contact</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("portfolio.php") ?>">Portfolio</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("blog.php") ?>">Blog</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("login.php") ?>">Login</a></li>
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

<script>
    document.getElementById('togglePassword').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent any default behavior

        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');

        // Toggle password visibility
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

</body>

</html>