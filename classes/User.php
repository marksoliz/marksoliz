<?php
class User
{
    // Database connection
    private $conn;
    private $table = 'users';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Register method
    public function register($username, $email, $password)
    {
        // Sanitize the input
        $username = htmlspecialchars(strip_tags($username));
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Login method
    public function login($email, $password)
    {
        // Sanitize the input
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));

        // Get the user from the database
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        // Check if the user exists and the password is correct
        if ($user) {

            if (password_verify($password, $user->password)) {

                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $user->email;

                return true;
            }
        }
        return false;
    }

    // Check if the user is logged in
    public function isLoggedIn()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            return true;
        }
        return false;
    }
}
