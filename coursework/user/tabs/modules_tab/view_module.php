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

        $module = getModuleById($pdo, $moduleId);

        if (!$module) {
            die('Module not found.');
        }

        // Get questions under this module
        $questions = getQuestionsInModule($pdo, $moduleId);

        ob_start();
        include 'templates/view_module.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include '../../templates/public_layout.html.php';