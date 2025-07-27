<?php 
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            include '../system/include/DatabaseConnection.php';
            include '../system/include/DatabaseFunction.php';

            $imageName = null;
            $uploadOk = 1;

            if (!empty($_FILES['fileToUpload']['name'])) {
                $context = "add";
                include 'uploadimg.php';
                if ($uploadOk == 0) {
                    exit();
                }
                $imageName = basename($_FILES['fileToUpload']['name']);
            }
            
            $userId = in_array('admin', $_SESSION['roles']) ? $_POST['users'] : $_SESSION['userid'];

            insertQuestion($pdo, $_POST['questtext'], $imageName, $userId, $_POST['modules']);
            header('location: forum.php');
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    } else {
        include '../system/include/DatabaseConnection.php';
        include '../system/include/DatabaseFunction.php';

        $title = 'Ask Question';
        $users = totalUsers($pdo);
        $modules = totalModules($pdo);
        ob_start();
        include 'templates/addquestion.html.php';
        $output = ob_get_clean();
    }

    include 'templates/public_layout.html.php';