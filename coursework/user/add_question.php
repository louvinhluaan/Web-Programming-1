<?php 
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $imageName = null;
            $uploadOk = 1;

            if (!empty($_FILES['fileToUpload']['name'])) {
                $context = "add";
                include 'uploadimg.php';
                if ($uploadOk == 0) {
                    exit();
                }
                $imageName = $target_file ? basename($target_file) : null;
            }
            
            $userId = in_array('admin', $_SESSION['roles']) ? $_POST['users'] : $_SESSION['userid'];

            addQuestion($pdo, $_POST['quest_title'], $_POST['questtext'], $imageName, $userId, $_POST['modules']);
            header('location: forum.php');
        } catch (PDOException $e) {
            $title = 'An error has occurred';
            $output = 'Database error: ' . $e->getMessage();
        }
    } else {
        $title = 'Ask Question';
        $users = totalUsers($pdo);
        $modules = totalModules($pdo);
        ob_start();
        include 'templates/add_question.html.php';
        $output = ob_get_clean();
    }

    include 'templates/public_layout.html.php';