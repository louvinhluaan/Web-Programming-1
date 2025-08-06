<?php
    include '../../system/login/check.php';
    include '../../system/include/DatabaseConnection.php';
    include '../../system/include/DatabaseFunction.php';

    try {
        if (!isset($_GET['id'])) {
            die('Question ID not provided.');
        }

        $id = $_GET['id'];
        deleteQuestion($pdo, $id);
        header('Location: ../managequestions.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }


