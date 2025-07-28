<?php
    session_start();
    try {
        include '../../../system/include/DatabaseConnection.php';
        include '../../../system/include/DatabaseFunction.php'; 

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("Invalid user ID.");
        }

        $user_id = $_GET['id'];

        // Check if user is editing their own profile
        if ($_SESSION['userid'] != $user_id) {
            die("Unauthorized access.");
        }

        // Fetch current data
        $stmt = $pdo->prepare("SELECT name, bio FROM user WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();

        if (!$user) {
            die("User not found.");
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $bio = trim($_POST['bio']);

            if (!empty($name)) {
                $stmt = $pdo->prepare("UPDATE user SET name = ?, bio = ? WHERE id = ?");
                $stmt->execute([$name, $bio, $user_id]);

                // Optionally redirect back to profile
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
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }

    include '../../templates/public_layout.html.php';
?>