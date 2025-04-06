<?php
class Contact
{
    // Database connection

    private $conn;
    private $table = 'contactform';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Insert contact form data
    public function insertContactForm($name, $email, $subject, $message)
    {
        $query = "INSERT INTO " . $this->table . " (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get all contact form submissions
    public function getContactFormSubmissions()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Delete contact form submission by ID
    public function deleteContactFormSubmission($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete multiple contact form submissions by IDs
    public function deleteSelectedMessages($ids)
    {
        if (!is_array($ids)) {
            throw new InvalidArgumentException('Expected an array of IDs.');
        }

        // Sanitize the IDs to ensure they are integers
        $ids = array_map('intval', $ids);

        // Convert the array of IDs into a comma-separated string
        $idList = implode(',', $ids);

        // Prepare the SQL query to delete multiple rows
        $query = "DELETE FROM $this->table WHERE id IN ($idList)";
        $stmt = $this->conn->prepare($query);

        // Execute the query
        return $stmt->execute();

        redirect('contact_form.php?success=1');
        exit();
    }
}
