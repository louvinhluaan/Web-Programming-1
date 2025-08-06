<?php 
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';    

    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Delete Question
            $row = getQuestionById($pdo, $id);
            if (in_array('admin', $_SESSION['roles']) || $_SESSION['userid'] == $row['userid']) {
                unlink('images/'.$row['images']);
                deleteQuestion($pdo, $id);
            }
            else {
                exit();
            }
            header('location: forum.php');
        }        


    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }

    include 'templates/public_layout.html.php';