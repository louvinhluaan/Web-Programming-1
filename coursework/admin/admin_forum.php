<?php
require '../system/login/check.php';

try {
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';
    

    $activeTab = 'adminforum';
    $title = 'Forum - GSQF';
    $total = totalQuestions($pdo);
    $questions = allQuestions($pdo);

    ob_start();
    include 'templates/admin_forum.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php';
