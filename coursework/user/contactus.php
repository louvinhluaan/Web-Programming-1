<?php
    include '../system/login/check.php';
    
    try {
        include '../system/include/DatabaseConnection.php';
        include '../system/include/DatabaseFunction.php';   

        $activeTab = 'contactus';
        $title = 'Contact Us';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name    = trim($_POST['name']);
            $email   = trim($_POST['email']);
            $message = trim($_POST['message']);

            if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) 
                                                    VALUES (:name, :email, :message)");
                    $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':message' => $message
                    ]);
                    header("Location: contactus.php?success=1");
                    exit();
                } catch (PDOException $e) {
                    // Log error if needed
                    header("Location: contactus.php?error=1");
                    exit();
                }
            } else {
                header("Location: contact.php?error=1");
                exit();
            }
        }

        ob_start();
        include 'templates/public_contactus.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }

    include 'templates/public_layout.html.php';