<?
class Posts
{

    private $conn;
    private $table = 'blog_posts';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all posts
    public function getPosts()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single post
    public function getPostById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Add post 
    public function addPost($title, $content, $image, $user_id)
    {
        $query = "INSERT INTO " . $this->table . " (title, content, image, user_id) VALUES (:title, :content, :image, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update post
    public function updatePost($id, $title, $content, $image)
    {
        $query = "UPDATE " . $this->table . " SET title = :title, content = :content, image = :image WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Delete post with image
    public function deletePostWithImage($id, $image)
    {
        // Delete the image from the server
        if (file_exists($image)) {
            unlink($image);
        }

        // Delete the post from the database
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    // Delete post without image
    public function deletePostWithoutImage($id)
    {
        // Delete the post from the database
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get posts by user
    public function getPostsByUserId($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get posts by category
    public function getPostsByCategoryId($categoryId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE category_id = :category_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get posts by date
    public function getPostsByDate($date)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE created_at = :created_at ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get posts by title
    public function getPostsByTitle($title)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE title LIKE :title ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':title', '%' . $title . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get posts by tags
    public function getPostsByTags($tags)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE tags LIKE :tags ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tags', '%' . $tags . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get posts by status
    public function getPostsByStatus($status)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = :status ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
