<?php

//Auto load classes
require_once "autoloader.php";

// Initialize the session
session_start();

// Include the database connection file
require_once "config/config.php";

// Load database class
// require_once "classes/Database.php";

// Include the helpers file
require_once "helpers.php";

// Define global constants: the app name-> CMS PDO System
define("APP_NAME", "MarkSoliz.com");
// Define global constants: the project directory-> cms-pdo
define("PROJECT_DIR", "marksoliz");
