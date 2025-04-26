<?php

// Function to return the base url
function base_url($path = "")
{
    //detect http or https
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? "https://" : "http://";
    //check for localhost or domain name
    $host = $_SERVER['HTTP_HOST'];
    //return the base url with the project directory
    $baseUrl = $protocol . $host;
    return $baseUrl . "/" . ltrim($path, '/');
}

// Function to return the base path
function base_path($path = "")
{
    $rootPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . PROJECT_DIR;
    return $rootPath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
}

// Function to return the path to the uploads folder
function upload_path($filename)
{
    return base_path("assets/blogImages" . DIRECTORY_SEPARATOR . $filename);
}

// Function to return the url to the uploads folder
function uploads_url($filename)
{
    return base_path("uploads/" . ltrim($filename, '/'));
}

// Function to return the url to the assets folder
function asset_url($path = "")
{
    return base_url("assets/" . ltrim($path, '/'));
}

// Funtion to redirect to a given path
function redirect($url)
{
    header("Location: " . base_url($url));
    exit();
}

function isPostRequest()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getPostData($field, $default = null)
{
    return isset($_POST[$field]) ? trim($_POST[$field]) : $default;
}


function escape($string)
{

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

//
function logout()
{
    // Start the session if it hasn't been started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Unset all session variables
    $_SESSION = [];

    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    // Destroy the session
    session_destroy();

    // Redirect to the homepage or login page
    redirect('index.php');
}

//format date
function formatDate($date)
{
    return date('F j, Y', strtotime($date));
}

function isUserLoggedIn()
{
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        return true;
    } else {
        return false;
    }
}

// Function to check if the user is logged in
function checkUserLoggedIn()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
        redirect('login.php');
    }
}

// Get Excerpt
function getExcerpt($content, $limit = 100)
{
    if (strlen($content) > $limit) {
        $content = substr($content, 0, $limit);
        $content = substr($content, 0, strrpos($content, ' '));
        $content = $content . '...';
    }
    return $content;
}
