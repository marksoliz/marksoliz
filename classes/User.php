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

    // Get all users
    public function getAllUsers($offset = 0, $perPage = null)
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";

        if ($perPage !== null) {
            $query .= " LIMIT :offset, :perPage";
        }

        $stmt = $this->conn->prepare($query);

        if ($perPage !== null) {
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get user by ID
    public function getUserById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Update user
    public function updateUser($id, $firstName, $lastName, $username, $email, $password = null)
    {
        // Sanitize the input
        $firstName = htmlspecialchars(strip_tags($firstName));
        $lastName = htmlspecialchars(strip_tags($lastName));
        $username = htmlspecialchars(strip_tags($username));
        $email = htmlspecialchars(strip_tags($email));

        // Prepare the query
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE " . $this->table . " SET firstName = :firstName, lastName = :lastName, username = :username, email = :email, password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':password', $hashedPassword);
        } else {
            $query = "UPDATE " . $this->table . " SET firstName = :firstName, lastName = :lastName, username = :username, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }

        // Bind parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }

    // Delete user
    public function deleteUser($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Delete selected users
    public function deleteSelectedUsers($userIds)
    {
        $ids = implode(',', array_map('intval', $userIds)); // Sanitize IDs
        $query = "DELETE FROM " . $this->table . " WHERE id IN ($ids)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    //Generate Dummy Users
    public function generateDummyUsers($count = null)
    {
        $query = "INSERT INTO " . $this->table . " (username, email, password, firstName, lastName) VALUES (:username, :email, :password, :firstName, :lastName)";
        $stmt = $this->conn->prepare($query);

        for ($i = 0; $i < $count; $i++) {
            $username = 'user' . rand(1, 10000);
            $email = 'user' . rand(1, 10000) . '@example.com';
            $password = password_hash('password', PASSWORD_BCRYPT);
            $firstName = 'First' . rand(1, 10000);
            $lastName = 'Last' . rand(1, 10000);

            // Bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);

            // Execute the query
            if (!$stmt->execute()) {
                return false;
            }
        }

        return true;
    }

    // Reorder users
    public function reorderUsers()
    {
        try {
            // Begin a transaction
            $this->conn->beginTransaction();

            // Fetch all users ordered by the current ID
            $query = "SELECT id FROM " . $this->table . " ORDER BY id ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Reset the ID counter
            $newId = 1;

            // Update each user's ID sequentially
            foreach ($users as $user) {
                $query = "UPDATE " . $this->table . " SET id = :newId WHERE id = :currentId";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':newId', $newId, PDO::PARAM_INT);
                $stmt->bindParam(':currentId', $user['id'], PDO::PARAM_INT);
                $stmt->execute();
                $newId++;
            }

            // Commit the transaction
            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            // Roll back the transaction in case of an error
            $this->conn->rollBack();
            return false;
        }
    }
}
