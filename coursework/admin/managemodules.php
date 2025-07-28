<?php
require '../system/login/check.php';
$adminName = $_SESSION['username'];

try {
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';
    

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
