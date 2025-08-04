<?php 
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';  
    $activeTab = 'modules';
    
    try {
        $title = 'Modules';
        $modules = getAllModules($pdo);

        ob_start();
        include 'templates/public_modules.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include 'templates/public_layout.html.php';