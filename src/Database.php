<?php
class Database {
    private $connection;

    public function __construct() {
        $this->connection = new mysqli('localhost', 'username', 'password', 'tweet_app');

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getCategories() {
        $result = $this->connection->query("SELECT * FROM Categories");
        return $result->fetch_all(MYSQLI_ASSOC); 
    }
}