<?php 
    require '../system/login/check.php';
    try {
        include '../system/include/DatabaseConnection.php';
        include '../system/include/DatabaseFunction.php';        


        $activeTab = 'modules';
        $title = 'Modules';

        $sql = 'SELECT name FROM module';
        $modules = $pdo->query($sql);


        ob_start();
        include 'templates/public_modules.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include 'templates/public_layout.html.php';