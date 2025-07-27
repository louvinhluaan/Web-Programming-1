<?php 
    session_start();
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';

    try {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $imageName = null;
                $uploadOk = 1;

                // Get original image from DB in case no new one is uploaded
                $existingQuestion = getQuestion($pdo, $_POST['id']);
                $imageName = $existingQuestion['images'];

                // If a new file is uploaded
                if (!empty($_FILES['fileToUpload']['name'])) {
                    $context = "edit";
                    $questionId = $_POST['id'];
                    include 'uploadimg.php';
                    if ($uploadOk == 0) {
                        exit();
                    }
                    $imageName = basename($_FILES['fileToUpload']['name']);
                }
                
                editQuestion(
                    $pdo, 
                    $_POST['id'], 
                    $_POST['questtext'], 
                    $imageName,  
                    $_POST['moduleid']
                );
                header('location: view_question.php?id=' . urlencode($_POST['id']));
            } catch (PDOException $e) {
                $title = 'An error has occurred';
                $output = 'Database error: ' . $e->getMessage();
            }

        } else {
            // Get request : Show form
            $id = $_GET['id'] ?? null;
            if (!$id) {
                die("Error: Invalid or missing question ID.");
            }

            $question = getQuestion($pdo, $id);
            if (!$question) {
                    die("Error: Question not found.");
            }            

            $title = 'Edit Question';
            $modules = totalModules($pdo);

            ob_start();
            include 'templates/editquestion.html.php';
            $output = ob_get_clean();
        }
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Error editing question: ' . $e->getMessage();
    }

    include 'templates/public_layout.html.php';