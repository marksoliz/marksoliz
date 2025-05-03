<?php
// filepath: c:\xampp\htdocs\marksoliz\app\models\User.php

class User
{

    private $table = 'users'; // Table name in the database
    public $id;
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $phone;
    public $birthday;
    public $organization;
    public $location;
    public $profile_image;
    public $created_at;
    public $updated_at;
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function store()
    {
        $query = "INSERT INTO $this->table (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $this->username = sanitize($this->username);
        $this->email = sanitize($this->email);

        $hashPassword = password_hash($this->password, PASSWORD_BCRYPT); // Hash the password

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashPassword); // Use the hashed password
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $this->email = sanitize($this->email);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        $dbuser = $stmt->fetch(PDO::FETCH_OBJ);

        if ($dbuser && password_verify($this->password, $dbuser->password)) {
            // Password is correct, set session variables or perform login actions
            $this->id = $dbuser->id;
            $this->username = $dbuser->username;
            $this->email = $dbuser->email;
            $this->first_name = $dbuser->first_name;
            $this->last_name = $dbuser->last_name;
            return true;
        } else {
            // Invalid email or password
            return false;
        }
    }
}
