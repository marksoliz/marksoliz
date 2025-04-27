<?php
require_once 'helpers.php'; // Include the helpers.php file where the logout() function is defined

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout(); // Call the logout function to destroy the session
    redirect(base_url("/")); // Redirect to the homepage or login page
    exit();
} else {
    // If the request is not POST, deny access or redirect
    header("HTTP/1.1 405 Method Not Allowed");
    echo "Method Not Allowed";
    exit();
}
