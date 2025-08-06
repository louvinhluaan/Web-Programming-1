<?php
    include '../../system/login/check.php';
    include '../../system/include/DatabaseConnection.php';
    include '../../system/include/DatabaseFunction.php';

    try {
        $title = 'Edit Module';

        if (!isset($_GET['id'])) {
            die('Module ID not provided.');
        }

        $id = $_GET['id'];
        $module = getModuleById($pdo, $id);

        if (!$module) {
            die('Module not found.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newName = trim($_POST['name']);

            if (!empty($newName)) {
                editModule($pdo, $id, $newName);
                header('Location: ../managemodules.php');
                exit;
            }
        }        

        ob_start();
        include 'templates/edit_module.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }

    include '../templates/admin_layout.html.php';
?>