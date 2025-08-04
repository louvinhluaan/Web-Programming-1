<?php
session_start();
$adminName = $_SESSION['username'];

try {
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';

    $title = 'Manage Questions';
    $questions = allQuestions($pdo);

    ob_start();
    include 'templates/manage_questions.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php';
