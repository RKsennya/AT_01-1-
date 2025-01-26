<?php
session_start();
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if (authenticate($password)) {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Неверный пароль';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Вход администратора</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Вход администратора</h1>
    <form method="post">
        <label>Пароль:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Войти">
        <?php if (isset($error)): ?>
            <p><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
