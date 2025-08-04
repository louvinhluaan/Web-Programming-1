<?php
    session_start();
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php'; 
    try {
        $question_id = $_POST['question_id'] ?? null;
        $answer_text = $_POST['answer_text'] ?? null;

        // Identify user_name
        if (isset($_SESSION['userid'])) {
            // Get user_name from DB
            $user_id = $_SESSION['userid'];
            $row = getUserById($pdo, $user_id);
            $user_name = $row['name'];
        }

        if (!$question_id || !$answer_text || !$user_name) {
            die('Something went wrong. Try again');
        }

        // Add answer
        addAnswer($pdo, $user_id, $question_id, $answer_text, $user_name);
        header("Location: view_question.php?id=" . $question_id);
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }

