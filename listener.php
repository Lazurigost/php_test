<?php
$redis = new Predis\Client();

while (true) {
    $tweetData = $redis->brpop('tweets_queue', 0);
    $data = json_decode($tweetData[1], true);
    // Добавьте код для сохранения в базу данных
}