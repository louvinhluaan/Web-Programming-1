<?php
    include '../../system/include/DatabaseConnection.php';
    include '../../system/include/DatabaseFunction.php';

    try {
        if (!isset($_GET['id']) || !isset($_GET['qid'])) {
            die('Missing parameters.');
        }

        $answerId = $_GET['id'];
        $questionId = $_GET['qid'];        
        deleteAnswer($pdo, $answerId);
        header('Location: adm_viewquestion.php?id=' . $questionId);
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }


