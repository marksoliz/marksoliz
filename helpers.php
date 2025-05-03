<?php

// Base URL
// This is the base URL of the application
// It is used to generate links and URLs in the application
// It is set to the current URL of the server
// This is useful for generating absolute URLs in the application
function base_url($path = '')
{

    if (defined('BASE_URL')) {

        return BASE_URL . ltrim($path, '/'); // Return the base URL with the path appended to it

    }
    // Check if the HTTPS server variable is set and not empty
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';

    // Get the host name from the server variables
    $host = $_SERVER['HTTP_HOST']; //marksoliz.com

    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); // Get the base directory of the script

    // $base_url = $protocol . $host . '/'; // Set the base URL to the current URL of the server

    return $protocol . $host . $base . '/' . ltrim($path, '/'); // Return the base URL with the path appended to it
}


function base_path($path = '')
{

    return realpath(__DIR__ . '/../' . '/' . ltrim($path, '/'));
}


function views_path($path = '')
{

    return base_path('app/views/' . ltrim($path, '/'));
}


function redirect($path = '', $queryParams = [])
{

    $url = base_url($path);
    if (!empty($queryParams)) {
        $url .= '?' . http_build_query($queryParams); // Build the query string from the array
    }

    header('Location: ' . $url); // Redirect to the URL
    exit; // Exit the script to prevent further execution
}


function render($view, $data = [], $layout = 'layout')
{


    // Extract the data array to variables
    // This will create variables from the keys of the array and assign them their values
    {
        //extract($data); // Extract the data array to variables
        // This is a more secure way to extract variables from the array
        extract($data);

        // Start output buffering
        // This allows us to capture the output of the view file
        // and store it in a variable instead of sending it directly to the browser
        // This is useful for rendering views in a framework or templating engine
        ob_start();

        // Include the view file
        // This will execute the PHP code in the view file and send the output to the buffer
        require views_path($view . '.php');

        // Get the contents of the buffer and clean it
        // This will return the output as a string and clear the buffer
        $content = ob_get_clean();

        require views_path($layout . ".php");
    }
}

function config($key)
{

    $config = require base_path('config/config.php');

    $keys = explode('.', $key); // Split the key by dot notation
    $value = $config; // Start with the full config array

    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            throw new Exception("Config key '{$key}' not found.");
        }

        $value = $value[$k]; // Traverse the config array using the keys
    }

    return $value; // Return the final value
}


function sanitize($data)
{

    return htmlspecialchars(strip_tags($data)); // Sanitize the input data by removing HTML tags and special characters
}

function isLoggedIn()
{

    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start the session if it is not already started
    }

    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']); // Check if the user is logged in by checking the session variable
}

function isAdmin()
{

    if (session_status() === PHP_SESSION_NONE) {
        session_start(); // Start the session if it is not already started
    }

    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'; // Check if the user is an admin by checking the session variable
}

function getUserFullName()
{

    if (isset($_SESSION['first_name'], $_SESSION['last_name']) && !empty($_SESSION['first_name']) && !empty($_SESSION['last_name'])) {
        return $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; // Concatenate first and last name if they are set and not empty
    } elseif (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        return $_SESSION['username']; // Return username if first and last name are not set or are empty
    } else {
        return 'Guest'; // Fallback if no valid session data is available
    }
}
