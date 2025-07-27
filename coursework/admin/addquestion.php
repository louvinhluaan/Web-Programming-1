<?php 
    if(isset($_POST['questtext'])) {
        try {
            include '../system/include/DatabaseConnection.php';
            include '../system/include/DatabaseFunction.php';
            insertQuestion($pdo, $_POST['questtext'], $_FILES['fileToUpload']['name'], $_POST['users'], $_POST['modules']);
            include '../system/include/uploadimg.php';
            header('location: admin_forum.php');
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    } else {
        include '../system/include/DatabaseConnection.php';
        include '../system/include/DatabaseFunction.php';

        $title = 'Add a new joke';
        $users = totalUsers($pdo);
        $modules = totalModules($pdo);
        ob_start();
        include 'templates/addquestion.html.php';
        $output = ob_get_clean();
    }

    include 'templates/admin_layout.html.php';