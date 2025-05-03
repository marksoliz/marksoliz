<?php
// filepath: c:\xampp\htdocs\marksoliz\app\middlewares\AuthMiddleware.php

class AuthMiddleware
{
    public static function isAuthenticated()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    public static function requiredLogin()
    {

        if (!self::isAuthenticated()) {
            // Redirect to the login page or show an error message
            redirect('/user/login');
            exit;
        }
    }
}
