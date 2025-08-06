<?php
include '../system/login/check.php';
include '../system/include/DatabaseConnection.php';
include '../system/include/DatabaseFunction.php';

$adminName = $_SESSION['username'];

try {
    $title = 'Contact Messages';
    $messages = getAllContactMessages($pdo);

    ob_start();
    include 'templates/contact_messages.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php';
