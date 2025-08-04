<?php 
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';    
    $activeTab = 'users';
 
    try {
        $title = 'Users';
        $users = getAllUsers($pdo);

        ob_start();
        include 'templates/public_users.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include 'templates/public_layout.html.php';