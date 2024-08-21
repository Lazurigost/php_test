<?php
require_once __DIR__ . '/../../src/Models/Category.php';
require_once __DIR__ . '/../../src/Models/Tweet.php';
use Models\Category;
use Models\Tweet;
class TweetController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        
    }
    
    
    
    public function getAllTweets() {
        $stmt = $this->db->query("SELECT tweets.id, tweets.category_id, tweets.username, tweets.content, tweets.createdAt, categories.title AS category_title FROM tweets JOIN categories ON tweets.category_id = categories.id");
        
        
        
        $tweets = [];
    
        // Итерируемся по результатам запроса
        while ($tweet = $stmt->fetchObject(Tweet::class)) {
            $tweets[] = $tweet;
        }
    
    return $tweets;
    }
    public function addTweet($categoryId, $username, $content) {
        $stmt = $this->db->prepare("INSERT INTO tweets (category_id, username, content) VALUES (?, ?, ?)");
        $stmt->execute([$categoryId, $username, $content]);
    }   
    
}