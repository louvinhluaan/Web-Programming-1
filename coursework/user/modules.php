<?php 
    include '../system/login/check.php';
    try {
        include '../system/include/DatabaseConnection.php';
        include '../system/include/DatabaseFunction.php';        


        $activeTab = 'modules';
        $title = 'Modules';

        $sql = 'SELECT m.id, m.name, m.description, COUNT(q.id) as total_questions
                FROM module m
                LEFT JOIN question q ON q.moduleid = m.id
                GROUP BY m.id';
        $modules = $pdo->query($sql);


        ob_start();
        include 'templates/public_modules.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include 'templates/public_layout.html.php';