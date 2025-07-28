<?php 
    include '../../../system/login/check.php';
    try {
        include '../../../system/include/DatabaseConnection.php';
        include '../../../system/include/DatabaseFunction.php';      

        $title = 'View Module';

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('Invalid module ID');
        }

        $moduleId = (int)$_GET['id'];

        $stmt = $pdo->prepare("SELECT * FROM module WHERE id = :id");
        $stmt->execute([':id' => $moduleId]);
        $module = $stmt->fetch();

        if (!$module) {
            die('Module not found.');
        }


        // Get questions under this module
        $stmt = $pdo->prepare("SELECT q.id, q.questtext, q.questdate, u.name AS author
                            FROM question q
                            JOIN user u ON q.userid = u.id
                            WHERE q.moduleid = :id
                            ORDER BY q.questdate DESC");
        $stmt->execute([':id' => $moduleId]);
        $questions = $stmt->fetchAll();

        ob_start();
        include 'templates/view_module.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include '../../templates/public_layout.html.php';