<?php
// session_start(); // Start the session
$config = require_once  __DIR__ . '/../config/config.php'; // Include the configuration file

if (!defined('BASE_URL')) {

    define('BASE_URL', $config['app']['base_url']);
}

require_once  __DIR__ . '/../config/database.php'; // Include the database file
require_once  __DIR__ . '/helpers.php'; // Include the helper functions
require_once  __DIR__ . '/autoloader.php'; // Include the autoloader file