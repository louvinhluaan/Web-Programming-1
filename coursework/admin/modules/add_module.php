<?php
    try {
        include '../../system/include/DatabaseConnection.php';
        include '../../system/include/DatabaseFunction.php';

        $title = 'Add Module';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if (!empty($name)) {
                addModule($pdo, $name);
                header('Location: ../managemodules.php');
                exit;
            }
        }        

        ob_start();
        include 'templates/add_module.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }

    include '../templates/admin_layout.html.php';

