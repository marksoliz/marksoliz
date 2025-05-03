<div class="container" style="display: flex; justify-content: center; align-items: center; vertical-align: middle; height: 50vh;">
    <div class="form-container" style="width: 100%; max-width: 400px; padding: 20px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <form method="POST" action="<?php echo base_url('/login') ?>">
            <h2 style="text-align: center;">Login</h2>

            <!-- Error message placeholder -->
            <p style="color:red; text-align: center;">
                <!-- Error message goes here -->
            </p>

            <label for="email">Email address:</label><br>
            <input type="text" name="email" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;"><br>

            <input type="submit" value="Login" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">

            <!-- Add "Don't have an account?" message -->
            <p style="text-align: center; margin-top: 15px;">
                Don't have an account? <a href="<?php echo base_url('user/register') ?>" style="color: #007bff; text-decoration: none;">Register</a>
            </p>
        </form>
    </div>
</div>