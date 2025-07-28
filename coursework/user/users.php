<?php 
    include '../system/login/check.php';
    try {
        include '../system/include/DatabaseConnection.php';
        include '../system/include/DatabaseFunction.php';        


        $activeTab = 'users';
        $title = 'Users';

        $sql = 'SELECT u.*, COUNT(q.id) AS total_questions
                FROM user u
                LEFT JOIN question q ON u.id = q.userid
                GROUP BY u.id
                ORDER BY u.created_at DESC';
        $users = $pdo->query($sql);


        ob_start();
        include 'templates/public_users.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include 'templates/public_layout.html.php';