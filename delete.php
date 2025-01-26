<?php
include 'functions.php';

// Проверка, передан ли индекс
if (isset($_GET['index'])) {
    $index = $_GET['index'];
    deleteResult($index);
}

// Перенаправление обратно в панель управления
header('Location: dashboard.php');
exit;
?>
