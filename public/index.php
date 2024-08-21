<?php
require_once '../src/Controllers/CategoryController.php';
require_once '../config/db_connection.php';
require_once __DIR__ . '/../src/Models/Category.php';
require_once __DIR__ . '/../src/Controllers/TweetController.php';
require_once __DIR__ . '/../src/Models/Tweet.php';
use Models\Tweet;
use Models\Category;
$categoryController = new CategoryController($pdo);
$tweetController = new TweetController($pdo);
$categories = $categoryController->getAllCategories();
$tweets = $tweetController->getAllTweets();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Твиты</title>
</head>
<body>
    <h1>Твиты</h1>
    <form method="POST" action="submit_tweet.php">
        <select name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category->id) ?>">
                    <?= htmlspecialchars($category->title) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="username" placeholder="Ваше имя" required>
        <textarea name="content" placeholder="Ваш твит" required></textarea>
        <button type="submit">Отправить</button>
    </form>
    <div id="tweets">
        <?php if (empty($tweets)): ?>
            <p>Нет доступных твитов.</p>
        <?php else: ?>
            <?php foreach ($tweets as $tweet): ?>
                <div class="tweet">
                    <p><strong><?php echo htmlspecialchars($tweet->username); ?></strong>: <?php echo htmlspecialchars($tweet->content); ?></p>
                    <p>Категория: <?php echo htmlspecialchars($tweet->category_title); ?></p>
                    <p>Дата: <?php echo date('Y-m-d H:i:s', strtotime($tweet->createdAt)); ?></p>
                </div>
                <?php console_log($tweet)?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var categories = <?php echo json_encode($categories); ?>;
    
    var categorySelect = $('#categorySelect');
    
    categories.forEach(function(category) {
        categorySelect.append('<option value="' + category.id + '">' + category.title + '</option>');
    });
});
</script>
</html>