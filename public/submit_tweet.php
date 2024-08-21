<?php
require_once __DIR__ . '/../config/db_connection.php'; 
require_once __DIR__ . '/../src/Models/Tweet.php'; 
require_once __DIR__ . '/../src/Controllers/TweetController.php'; 
require_once __DIR__ . '/../vendor/autoload.php';

use Predis\Client;
$tweetController = new TweetController($pdo);
// Создаем клиент Redis
$client = new Client([
    'scheme' => 'tcp',
    'host'   => 'redis',
    'port'   => 6379,
]);


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'];
    $username = $_POST['username'];
    $content = $_POST['content'];

    $tweet = [
       'category_id' => $categoryId,
       'username' => $username,
       'content' => $content,
    ];


    $client->lpush('tweets', json_encode($tweet));
    
    // Обработка твитов из очереди
        while (true) {
            $tweetJson = $client->rpop('tweets');
        
            if ($tweetJson) {
                $tweetData = json_decode($tweetJson, true);
                $tweetController->addTweet($categoryId, $username, $content);
            } else {
                break; 
            }
        }
    }
    header('Location: index.php'); 
        exit;
?>
