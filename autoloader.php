<?php
// filepath: c:\xampp\htdocs\marksoliz\app\autoloader.php

spl_autoload_register(function ($class_name) {
    $paths = [
        __DIR__ . '/controllers/',
        __DIR__ . '/models/',
        __DIR__ . '/middlewares/',
    ];

    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // If the class is not found, throw an error
    throw new Exception("Class $class_name not found.");
});;
