<?php

// Загружаем вопросы
function loadQuestions() {
    return json_decode(file_get_contents('questions.json'), true);
}

// Загружаем результаты
function loadResults() {
    return json_decode(file_get_contents('results.json'), true);
}

// Сохраняем результаты
function saveResults($results) {
    file_put_contents('results.json', json_encode($results, JSON_PRETTY_PRINT));
}

// Валидируем ответы
function validateAnswers($questions, $answers) {
    $correctCount = 0;
    $details = [];
    foreach ($questions as $index => $question) {
        $userAnswer = isset($answers[$index]) ? $answers[$index] : [];
        $correctAnswers = array_keys(array_filter($question['answers'], function($a) {
            return $a['correct'] == 1;
        }));
        $details[$index] = ['question' => $question['question'], 'userAnswer' => $userAnswer];
        if ($question['type'] === 'single') {
            if (in_array($userAnswer, $correctAnswers)) $correctCount++;
        } elseif ($question['type'] === 'multiple') {
            if (sort($userAnswer) == sort($correctAnswers)) $correctCount++;
        }
    }
    return ['correctCount' => $correctCount, 'details' => $details];
}

// Проверка пароля для админов
function authenticate($password) {
    $storedPassword = '123'; // Пароль администратора
    return password_verify($password, password_hash($storedPassword, PASSWORD_DEFAULT));
}

// Удаляем результат
function deleteResult($index) {
    $results = loadResults();
    if (isset($results[$index])) {
        array_splice($results, $index, 1);
        saveResults($results);
    }
}

// Редактируем результат
function editResult($index, $score, $percentage) {
    $results = loadResults();
    if (isset($results[$index])) {
        $results[$index]['score'] = $score;
        $results[$index]['percentage'] = $percentage;
        saveResults($results);
    }
}
?>
