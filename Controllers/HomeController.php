<?php



class HomeController
{
    public function index()
    {
        // This method is responsible for rendering the home page
        // $database = Database::getInstance();
        // $connection = $database->getConnection();
        $data = [
            'title' => 'Home',
            'message' => 'Welcome to the home page!',
        ];

        // Render the view with the data
        // This will include the view file and pass the data to it
        render('home/index', $data, 'layouts/hero_layout');
    }

    public function about()
    {

        $data = [
            'title' => 'About Page',
            'message' => 'Welcome to the About page!',
        ];

        // Render the view with the data
        // This will include the view file and pass the data to it
        render('home/about', $data);
    }


    public function contact()
    {

        $data = [
            'title' => 'Contact Page',
            'message' => 'Welcome to the Contact page!',
        ];

        // Render the view with the data
        // This will include the view file and pass the data to it
        render('home/contact', $data);
    }
}
