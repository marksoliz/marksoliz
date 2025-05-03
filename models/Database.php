<?php

class Database
{
    private static $instance = null;
    private $connection;

    public function __construct()
    {
        $host = config('database.host');
        $dbname = config('database.database');
        $username = config('database.username');
        $password = config('database.password');
        $port = config('database.port');
        $charset = config('database.charset');

        $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset};port={$port}";
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function __clone()
    {
        // Prevent cloning of the instance
    }

    public function __wakeup()
    {
        // Prevent unserializing of the instance
    }

    // public function query($sql, $params = [])
    // {
    //     $stmt = $this->connection->prepare($sql);
    //     $stmt->execute($params);
    //     return $stmt;
    // }
}
