<?php
    include '../../system/include/DatabaseConnection.php';
    include '../../system/include/DatabaseFunction.php';

    try {
        if (!isset($_GET['id'])) {
            die('User ID not provided.');
        }

        $id = $_GET['id'];
        deleteUser($pdo, $id);
        header('Location: ../manageusers.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }


