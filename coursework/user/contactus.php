<?php
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';       
    $activeTab = 'contactus';

    try {
        $title = 'Contact Us';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name    = trim($_POST['name']);
            $email   = trim($_POST['email']);
            $message = trim($_POST['message']);

            if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
                try {
                    addContactMessages($pdo, $name, $email, $message);
                    $_SESSION['success'] = 'Your message has been sent successfully!';
                    header("Location: contactus.php");
                    exit();
                } catch (PDOException $e) {
                    $_SESSION['error'] = 'Something went wrong. Please try again.';
                    header("Location: contactus.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Something went wrong. Please try again.';
                header("Location: contactus.php");
                exit();
            }
        }

        ob_start();
        include 'templates/public_contactus.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }

    include 'templates/public_layout.html.php';