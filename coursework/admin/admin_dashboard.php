<?php
require '../system/login/check.php';
$adminName = $_SESSION['username'];

try {
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';
    

    $title = 'Admin Dashboard';
    $questions = allQuestions($pdo);
    $users = getAllUsers($pdo);
    $modules = getAllModules($pdo);

    ob_start();
    include 'templates/dashboard.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php';
