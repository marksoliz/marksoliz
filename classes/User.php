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

    // Does User Exsists
    public function userExists($username)
    {
        // Sanitize the input
        $username = htmlspecialchars(strip_tags($username));

        // Query to check if the user exists
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $count = $stmt->fetchColumn();

        // Return true if the user exists, false otherwise
        return $count > 0;
    }

    // Check if email exists
    public function emailExists($email)
    {
        // Sanitize the input
        $email = htmlspecialchars(strip_tags($email));

        // Query to check if the email exists
        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);

        // Execute the query
        $stmt->execute();

        // Fetch the result
        $count = $stmt->fetchColumn();

        // Return true if the email exists, false otherwise
        return $count > 0;
    }

    // Register method
    public function register($firstName, $lastName, $username, $email, $password)
    {
        // Sanitize the input
        $firstName = htmlspecialchars(strip_tags($firstName));
        $lastName = htmlspecialchars(strip_tags($lastName));
        $username = htmlspecialchars(strip_tags($username));
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $query = "INSERT INTO " . $this->table . " (username, email, password, firstName, lastName) VALUES (:username, :email, :password, :firstName, :lastName)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Login method
    public function login($username, $password)
    {
        // Sanitize the input
        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));

        // Get the user from the database
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        // Check if the user exists and the password is correct
        if ($user) {

            if (password_verify($password, $user->password)) {

                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $user->email;
                $_SESSION['firstName'] = $user->firstName;
                $_SESSION['lastName'] = $user->lastName;
                $_SESSION['user_role'] = $user->user_role; // Assuming you have a role column in your users table


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
