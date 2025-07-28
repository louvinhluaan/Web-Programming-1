<?php
require '../system/login/check.php';
$adminName = $_SESSION['username'];

try {
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';
    

    $title = 'Contact Messages';
    $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll();

    ob_start();
    include 'templates/contact_messages.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php';
