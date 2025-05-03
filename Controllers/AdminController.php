<?php

class AdminController
{

    public function __construct()
    {
        // Middleware to check if the user is an admin
        // $this->middleware('auth:admin');

        AuthMiddleware::requiredLogin();
    }

    public function dashboard()
    {

        // Code to display the admin dashboard
        $data = [
            'title' => 'Admin Dashboard',
            'message' => 'Welcome To Your Admin Dashboard!',
        ];

        // Render the view with the data
        // This will include the view file and pass the data to it
        render('admin/dashboard', $data, 'layouts/admin_layout');
    }

    public function manageUsers()
    {
        // Code to manage users
        // return view('admin.manage_users');
    }

    public function managePosts()
    {
        // Code to manage posts
        // return view('admin.manage_posts');
    }

    public function settings()
    {
        // Code to display settings page
        //return view('admin.settings');
    }
}
