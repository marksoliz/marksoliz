<?php

class Article
{
    // Database connection
    private $conn;
    private $table = 'blog_posts';

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all published articles
    public function getPublishedArticles()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 'published' ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get random published articles
    public function getRandomPublishedArticles($limit = 1)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 'published' ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get all drafts
    public function getDrafts()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 'draft' ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get all articles
    public function getArticles($offset = 0, $perPage = null)
    {
        $query = "SELECT {$this->table}.*, categories.name AS category_name 
                  FROM {$this->table} 
                  LEFT JOIN categories ON {$this->table}.category_id = categories.id 
                  ORDER BY {$this->table}.id DESC";

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
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function generateUniqueSlug($title)
    {
        // Convert the title to a slug
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));

        // Check if the slug already exists
        $originalSlug = $slug;
        $count = 1;

        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    private function slugExists($slug)
    {
        $query = "SELECT COUNT(*) FROM blog_posts WHERE slug = :slug";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Create article
    public function createArticle($title, $date, $content, $image, $categoryId, $tags)
    {
        // Generate the slug
        $slug = $this->generateUniqueSlug($title);

        $query = "INSERT INTO blog_posts (title, content, user_id, created_at, image, status, category_id, tags, slug) 
                  VALUES (:title, :content, :user_id, :created_at, :image, :status, :category_id, :tags, :slug)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $date, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
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
                if (!empty($article->image) && file_exists(base_path($article->image))) {
                    if (!unlink(base_path($article->image))) {
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
        // $placeholders = implode(',', array_fill(0, count($articleIds), '?'));
        // $query = "DELETE FROM " . $this->table . " WHERE id IN ($placeholders)";
        // $stmt = $this->conn->prepare($query);
        // return $stmt->execute($articleIds);

        try {
            // Retrieve the articles to get their image paths
            $placeholders = implode(',', array_fill(0, count($articleIds), '?'));
            $query = "SELECT id, image FROM " . $this->table . " WHERE id IN ($placeholders)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute($articleIds);
            $articles = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Delete the images if they exist
            foreach ($articles as $article) {
                if (!empty($article->image) && file_exists($article->image)) {
                    unlink($article->image);
                }
            }

            // Delete the articles from the database
            $deleteQuery = "DELETE FROM " . $this->table . " WHERE id IN ($placeholders)";
            $deleteStmt = $this->conn->prepare($deleteQuery);
            return $deleteStmt->execute($articleIds);
        } catch (Exception $exception) {
            // Handle any exceptions
            throw $exception;
        }
    }

    // Generate dummy data
    public function generateDummyData($count = null)
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

    // Reorder articles
    public function reorderArticles()
    {
        try {
            // Start the DB transaction
            if (!$this->conn->inTransaction()) {
                $this->conn->beginTransaction();
            }

            // Get all articles
            $query = "SELECT id FROM " . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $articles = $stmt->fetchAll(PDO::FETCH_OBJ);

            // Update each article ID sequentially
            $newId = 1;
            foreach ($articles as $article) {
                $updateQuery = "UPDATE " . $this->table . " SET id = :new_id WHERE id = :old_id";
                $updateStmt = $this->conn->prepare($updateQuery);
                $updateStmt->bindParam(':new_id', $newId, PDO::PARAM_INT);
                $updateStmt->bindParam(':old_id', $article->id, PDO::PARAM_INT);
                $updateStmt->execute();
                $newId++;
            }

            // Reset auto-increment ID
            $nextAutoIncrement = $newId;
            $resetQuery = "ALTER TABLE " . $this->table . " AUTO_INCREMENT = :next_auto_increment";
            $resetStmt = $this->conn->prepare($resetQuery);
            $resetStmt->bindParam(':next_auto_increment', $nextAutoIncrement, PDO::PARAM_INT);
            $resetStmt->execute();

            // Commit the transaction
            if ($this->conn->inTransaction()) {
                $this->conn->commit();
            }
            return true;
        } catch (Exception $exception) {
            // Rollback the transaction if an error occurs, but only if a transaction is active
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            throw $exception;
        }
    }
}
