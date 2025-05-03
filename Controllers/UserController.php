<?php

class UserController
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }


    public function showRegisterForm()
    {
        $data = [
            'title' => 'Register',
            'description' => 'Create a new account',
        ];

        render('user/register');
    }


    public function register()
    {


        $this->userModel->username = $_POST['username'];
        $this->userModel->email = $_POST['email'];
        $this->userModel->password = $_POST['password'];

        if ($this->userModel->store()) {
            redirect('/');
        } else {

            echo "Error: User registration failed.";
            // Optionally, you can redirect to an error page or show an error message
        }
    }


    public function showLoginForm()
    {
        $data = [
            'title' => 'Login',
            'description' => 'Login to your account',
        ];

        render('user/login', $data);
    }

    public function loginUser()
    {


        $this->userModel->email = $_POST['email'];
        $this->userModel->password = $_POST['password'];

        if ($this->userModel->login()) {
            // Set session variables or perform login actions
            $_SESSION['user_id'] = $this->userModel->id;
            $_SESSION['username'] = $this->userModel->username;
            $_SESSION['email'] = $this->userModel->email;
            $_SESSION['first_name'] = $this->userModel->first_name;
            $_SESSION['last_name'] = $this->userModel->last_name;
            redirect('/dashboard');
        } else {
            echo "Error: Invalid email or password.";
            // Optionally, you can redirect to an error page or show an error message
        }
    }

    public function logoutUser()
    {
        $_SESSION = []; // Clear session variables
        session_destroy(); // Destroy the session or perform logout actions
        redirect('user/login'); // Redirect to the login page or home page
    }
}
