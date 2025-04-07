<?php

class Article
{
    // Database connection
    private $conn;
    private $table = 'articles';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all articles
    public function getArticles()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get Excerpt
    public function getExcerpt($content, $limit = 200)
    {
        if (strlen($content) > $limit) {
            $content = substr($content, 0, $limit);
            $content = substr($content, 0, strrpos($content, ' '));
            $content = $content . '...';
        }
        return $content;
    }

    // Get single article   
    public function getArticleById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_OBJ);

        if ($article) {

            if ($article->user_id == $_SESSION['user_id']) {
                return  $article;
            } else {
                redirect('admin.php');
            }
        } else {
            return false;
        }
    }


    // Get single article with owner  
    public function getArticleWithOwnerById($id)
    {
        $query = "SELECT articles.id, articles.title, articles.content, articles.image, articles.created_at, users.username AS author, users.email AS author_email FROM " . $this->table . " JOIN users ON articles.user_id = users.id WHERE articles.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_OBJ);

        if ($article) {
            return  $article;
        } else {
            return false;
        }
    }

    //Get articles by user
    public function getArticlesByUserId($userId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Create article
    public function createArticle($title, $date, $content, $image)
    {
        $query = "INSERT INTO " . $this->table . " (title, content, image, created_at, user_id) VALUES (:title, :content, :image, :created_at, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update article
    public function updateArticle($id, $title, $date, $content, $image = null)
    {
        $article = $this->getArticleById($id);

        if ($article) {
            // Check if the user is the owner of the article
            if ($article->user_id == $_SESSION['user_id']) {
                // Delete the existing image only if a new image is being uploaded
                if (!empty($image) && !empty($article->image) && file_exists($article->image)) {
                    if (!unlink($article->image)) {
                        return false;
                    }
                }

                $query = "UPDATE " . $this->table . " SET title = :title, content = :content, image = :image, created_at = :created_at WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':content', $content, PDO::PARAM_STR);
                $stmt->bindParam(':image', $image, PDO::PARAM_STR);
                $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            } else {
                redirect('admin.php');
            }
        }

        return false;
    }

    //upload image
    public function uploadImage($file)
    {

        $targetDir = 'uploads/';

        // Create uploads directory if it doesn't exist
        if (!is_dir(base_path('uploads'))) {
            mkdir(base_path('uploads'), 0777, true);
        }
        // Check if image is uploaded
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {

            // Check if image is valid
            $targetFile = $targetDir . basename($file['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            //Allowed image types
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            // Check if image is allowed file type
            if (in_array($imageFileType, $allowedTypes)) {

                $uniqueFileName = uniqid() . '-' . time() . '.' . $imageFileType;
                $targetFile = $targetFile . "_" . $uniqueFileName;

                // Move image to uploads directory
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    return $targetFile;
                } else {
                    return 'There was an error uploading the file';
                }
            } else {
                return 'Invalid file type error. Only JPG, JPEG, PNG and GIF types are allowed';
            }
        }
        return "";
    }

    // Delete article
    public function deleteArticleWithImage($id)
    {
        $article = $this->getArticleById($id);

        if ($article) {
            // Check if the user is the owner of the article
            if ($article->user_id == $_SESSION['user_id']) {
                // Delete the image if it exists
                if (!empty($article->image) && file_exists($article->image)) {
                    if (!unlink($article->image)) {
                        return false;
                    }
                }

                $query = "DELETE FROM " . $this->table . " WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                return $stmt->execute();
            } else {
                redirect('admin.php');
            }
        }

        return false;
    }

    // Delete multiple articles with images
    public function deleteMultipleArticlesWithImage($articleIds)
    {

        $placeholders = implode(',', array_fill(0, count($articleIds), '?'));
        $query = "DELETE FROM " . $this->table . " WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($articleIds);
    }


    // Generate dummy data
    public function generateDummyData($count = 10)
    {
        $query = "INSERT INTO " . $this->table . " (title, content, user_id, created_at, image) VALUES (:title, :content, :user_id, :created_at, :image)";
        $stmt = $this->conn->prepare($query);

        $dummyTitles = [
            "Lorem ipsum dolor sit amet",
            "Consectetur adipiscing elit",
            "Sed do eiusmod tempor incididunt",
            "Ut labore et dolore magna aliqua",
            "Ut enim ad minim veniam",
            "Quis nostrud exercitation ullamco laboris",
            "Nisi ut aliquip ex ea commodo consequat",
            "Duis aute irure dolor in reprehenderit",
            "In voluptate velit esse cillum dolore",
            "Excepteur sint occaecat cupidatat non proident"
        ];

        $dummyContent = "Veniam enim culpa reprehenderit sunt quis quis ullamco tempor deserunt ut. Mollit adipisicing consequat reprehenderit velit. Non exercitation ipsum non esse deserunt minim pariatur. Esse officia cillum id tempor est ex est commodo sit adipisicing mollit. Qui commodo nostrud cillum nisi qui et Lorem. Cillum enim enim in officia in labore sunt ullamco aliqua dolore consectetur velit do deserunt.";

        $dummyImage = "https://placehold.co/350x200";

        $userId = $_SESSION['user_id'];
        $createdAt = date('Y-m-d');

        for ($i = 0; $i < $count; $i++) {
            $title = $dummyTitles[array_rand($dummyTitles)];
            $content = $dummyContent;
            $image = $dummyImage;

            // Bind parameters
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $createdAt, PDO::PARAM_STR);
            $stmt->bindParam(':image', $image, PDO::PARAM_STR);

            // Execute the statement
            if (!$stmt->execute()) {
                return false;
            }
        }
        return true;
    }
}
