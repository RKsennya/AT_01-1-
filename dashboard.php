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
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Административная панель</title>
</head>
<body>
<div class="container">
    <h1>Результаты теста</h1>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Правильные ответы</th>
            <th>Процент</th>
            <th>Время</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($results as $index => $result): ?>
            <tr>
                <td><?= htmlspecialchars($result['name']); ?></td>
                <td><?= htmlspecialchars($result['correctCount']); ?></td>
                <td><?= htmlspecialchars($result['score']); ?>%</td>
                <td><?= htmlspecialchars($result['time']); ?></td>
                <td>
                    <!-- Удаление -->
                    <a href="delete.php?index=<?= $index ?>" onclick="return confirm('Вы уверены, что хотите удалить этот результат?');">Удалить</a> |
                    <!-- Редактирование -->
                    <a href="edit.php?index=<?= $index ?>">Редактировать</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="logout.php"><button>Выйти</button></a>
</div>
</body>
</html>
