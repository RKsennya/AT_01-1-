<?php
session_start();
include 'functions.php';

// Проверка авторизации
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Загрузка результатов
$results = loadResults();

// Проверка, передан ли индекс
if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $result = $results[$index];
} else {
    header('Location: dashboard.php');
    exit;
}

// Обработка формы редактирования
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = $_POST['score'];
    $percentage = $_POST['percentage'];
    editResult($index, $score, $percentage);
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Редактировать результат</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Редактирование результата</h1>
    <form method="post">
        <label>Имя:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($result['name']); ?>" disabled><br><br>

        <label>Правильных ответов:</label>
        <input type="number" name="score" value="<?= htmlspecialchars($result['correctCount']); ?>" required><br><br>

        <label>Процент:</label>
        <input type="number" name="percentage" value="<?= htmlspecialchars($result['percentage']); ?>" required><br><br>

        <input type="submit" value="Обновить">
    </form>
    <a href="dashboard.php"><button>Назад</button></a>
</div>
</body>
</html>
