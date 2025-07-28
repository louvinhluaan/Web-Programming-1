<?php
    try {
        include '../../system/include/DatabaseConnection.php';
        include '../../system/include/DatabaseFunction.php';

        if (!isset($_GET['id'])) {
            die('User ID not provided.');
        }

        $id = $_GET['id'];
        $user = getUserById($pdo, $id);

        if (!$user) {
            die('User not found.');
        }

        $title = 'Edit User';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newName = $_POST['name'];
            $newEmail = $_POST['email'];

            updateUser($pdo, $id, $newName, $newEmail);

            header('Location: ../manageusers.php');
            exit;
        }        

        ob_start();
        include 'templates/edit_user.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }

    include '../templates/admin_layout.html.php';

