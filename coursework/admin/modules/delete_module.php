<?php
    include '../../system/include/DatabaseConnection.php';
    include '../../system/include/DatabaseFunction.php';

    try {
        if (!isset($_GET['id'])) {
            die('Module ID not provided.');
        }

        $id = $_GET['id'];
        deleteModule($pdo, $id);
        header('Location: ../managemodules.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }


