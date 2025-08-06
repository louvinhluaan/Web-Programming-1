<?php
    include '../../../system/login/check.php';
    include '../../../system/include/DatabaseConnection.php';
    include '../../../system/include/DatabaseFunction.php';    
    try {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("Invalid user ID.");
        }

        $user_id = $_GET['id'];
        $loggedInUserId = $_SESSION['userid'];


        // Check ownership: reject if current user doesn't match the profile
        if ($user_id != $loggedInUserId) {
            die("Unauthorized: You are not allowed to edit this profile.");
        }

        $user = getUserById($pdo, $user_id);
        if (!$user) {
            die("User not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $bio = trim($_POST['bio']);

            if (!empty($name)) {
                editProfile($pdo, $name, $bio, $user_id);

                header("Location: view_profile.php?id=$user_id");
                exit;
            } else {
                $error = "Name cannot be empty.";
            }
        }

        $title = 'Edit Profile';
        ob_start();
        include 'templates/edit_profile.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }

    include '../../templates/public_layout.html.php';
?>