<?php
include 'functions.php';
$questions = loadQuestions();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['answers']) || count($_POST['answers']) < count($questions)) {
        echo "<p>Вы должны ответить на все вопросы!</p>";
    } else {
        $name = htmlspecialchars($_POST['name']) ?: "Аноним";
        $answers = $_POST['answers'];
        $resultData = validateAnswers($questions, $answers);
        $score = round(($resultData['correctCount'] / count($questions)) * 100, 2);
        $results = loadResults();
        $results[] = [
            'name' => $name,
            'score' => $score,
            'correctCount' => $resultData['correctCount'],
            'details' => $resultData['details'],
            'time' => date('Y-m-d H:i:s')
        ];
        saveResults($results);
        header("Location: results.php?score=$score&correctCount={$resultData['correctCount']}");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Тест</title>
</head>
<body>
<div class="container">
    <h1>Пройдите тест</h1>
    <form method="post">
        <label>Ваше имя (необязательно):</label>
        <input type="text" name="name"><br><br>
        <?php foreach ($questions as $index => $question): ?>
            <h3><?= htmlspecialchars($question['question']); ?></h3>
            <?php foreach ($question['answers'] as $key => $answer): ?>
                <label>
                    <input type="<?= $question['type'] === 'single' ? 'radio' : 'checkbox'; ?>"
                           name="answers[<?= $index; ?>]<?= $question['type'] === 'multiple' ? '[]' : ''; ?>"
                           value="<?= $key; ?>">
                    <?= htmlspecialchars($answer['text']); ?>
                </label><br>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Завершить тест">
    </form>
</div>
</body>
</html>
