<?php
// Path: autoloader.php
// Register the autoloader
spl_autoload_register(function ($class_name) {
    // Define the directory where the classes are stored
    $directory =  __DIR__ . '/classes/';
    // Concatenate the directory with the class name and the .php extension
    $file = $directory . $class_name . '.php';
    // Check if the file exists
    if (file_exists($file)) {
        // Require the file
        require_once $file;
    } else {
        // If the file does not exist, throw an exception
        die("Class file for {$class_name} not found in {$file}");
    }
});
