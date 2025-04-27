<?php
// Check if the user is logged in
if (isUserLoggedIn()): ?>
    <div class="container mt-5">
        <h3>Leave a Comment</h3>
        <form method="POST" action="submit-comment.php">
            <input type="hidden" name="article_id" value="<?php echo $articleData->id; ?>"> <!-- Hidden field for article ID -->

            <div class="mb-3">
                <label for="user_name" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label for="user_email" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">Your Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Write your comment here" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary rounded">Submit Comment</button>
        </form>
    </div>
<?php else: ?>
    <div class="container mt-5 rounded">
        <h3>Leave a Comment</h3>
        <p class="alert alert-secondary">You need to be logged in to leave a comment. <a href="<?php echo base_url('login') ?>" class="btn btn-primary rounded">Log in</a> or <a href="<?php echo base_url('register') ?>" class="btn btn-primary rounded">Register</a></p>
    </div>
<?php endif; ?>