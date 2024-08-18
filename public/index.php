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
            <!-- Здесь будет код для отображения категорий -->
        </select>
        <input type="text" name="username" placeholder="Ваше имя" required>
        <textarea name="content" placeholder="Ваш твит" required></textarea>
        <button type="submit">Отправить</button>
    </form>
    <div id="tweets">
        <!-- Здесь будет код для отображения твитов -->
    </div>
</body>
</html>