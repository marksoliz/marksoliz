<?php

class Comment
{
    private $conn;
    private $table = 'comments';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    // Get all comments
    public function getAllComments()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    // Get single comment
    public function getCommentById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Add Reply
    public function addReply($comment_id, $reply)
    {
        $query = "INSERT INTO replies (comment_id, reply) VALUES (:comment_id, :reply)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $stmt->bindParam(':reply', $reply, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
