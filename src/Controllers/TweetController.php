<?php
namespace Controllers;

use Models\Tweet;
use Models\Category;

class TweetController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllTweets() {
        $stmt = $this->db->query("SELECT tweets.*, categories.title as category_title FROM tweets JOIN categories ON tweets.category_id = categories.id");
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Tweet::class);
    }

    public function addTweet($categoryId, $username, $content) {
        $stmt = $this->db->prepare("INSERT INTO tweets (category_id, username, content) VALUES (?, ?, ?)");
        $stmt->execute([$categoryId, $username, $content]);
    }
}