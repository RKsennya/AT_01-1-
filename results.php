<?php
// Проверяем наличие переменных в $_GET с использованием isset() и устанавливаем значение по умолчанию
$score = isset($_GET['score']) ? $_GET['score'] : 0;
$correctCount = isset($_GET['correctCount']) ? $_GET['correctCount'] : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Результат</title>
</head>
<body>
<div class="container">
    <h1>Ваш результат</h1>
    <p>Правильных ответов: <?= $correctCount; ?></p>
    <p>Процент набранных баллов: <?= $score; ?>%</p>
    <a href="index.php"><button>На главную</button></a>
</div>
</body>
</html>
