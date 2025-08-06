<?php
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';    
    try {
        $userName = null;
        if (isset($_SESSION['userid'])) {
            $row = getUserById($pdo, $_SESSION['userid']);
            $userName = $row['name'] ?? null;
        }

        $question_id = $_GET['id'] ?? null;
        if (!$question_id || !is_numeric($question_id)) {
            die('Question not found.');
        }

        // Get question + user + module
        $question = getQuestionById($pdo, $question_id);

        if (!$question) {
            die('No matching question.');
        }

        // Get the list of answers (if there are answers in the table)
        $answers = [];
        if (tableExists($pdo, 'answers')) {
            $answers = getAnswersByQuestionId($pdo, $question_id);
        }

        $title = 'View Question';
        ob_start();
        include 'templates/view_question.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }

    include 'templates/public_layout.html.php';
