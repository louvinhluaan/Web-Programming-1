<?php
    include '../../system/login/check.php';
    include '../../system/include/DatabaseConnection.php';
    include '../../system/include/DatabaseFunction.php';    

    try {
        if (!isset($_GET['id'])) {
            die('Question ID not provided.');
        }

        $id = $_GET['id'];
        $question = getQuestionById($pdo, $id);

        if (!$question) {
            die('Question not found.');
        }

        $answers = getAnswersByQuestionId($pdo, $id);
        
        $title = 'View Question';
        ob_start();
        include 'templates/adm_viewquestion.html.php';
        $output = ob_get_clean();

    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }

    include '../templates/admin_layout.html.php';
