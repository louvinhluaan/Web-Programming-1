<?php
session_start();
include '../system/include/DatabaseConnection.php';
include '../system/include/DatabaseFunction.php';

$adminName = $_SESSION['username'];

try {
    $title = 'Manage Modules';
    $modules = getAllModules($pdo);

    ob_start();
    include 'templates/manage_modules.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/admin_layout.html.php';
