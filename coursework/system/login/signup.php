<?php
session_start();
include '../include/DatabaseConnection.php';
include '../include/DatabaseFunction.php';

if(isset($_POST['name'])){
    try{
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $passwordAgain = $_POST['password_again'];

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email.';
            header("Location: templates/signup.html.php");
            exit();
        }

        // Validate password length
        if (strlen($password) < 8 || strlen($password) > 20) {
            $_SESSION['error'] = 'Password must be between 8 and 20 characters.';
            header("Location: templates/signup.html.php");
            exit();
        }

        // Check matching password
        if ($password !== $passwordAgain) {
            $_SESSION['error'] = 'Passwords do not match.';
            header("Location: templates/signup.html.php");
            exit();
        }
        
        // Check if username is already taken
        $takenName = checkTakenUsername($pdo, $name);
        if ($takenName) {
            $_SESSION['error'] = 'Username is already taken.';
            header("Location: templates/signup.html.php");
            exit();
        }

        // Check if gmail is already taken
        $takenEmail = checkTakenEmail($pdo, $email);
        if ($takenEmail) {
            $_SESSION['error'] = 'Email is already registered.';
            header("Location: templates/signup.html.php");
            exit();
        }
        
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add new user
        addUser($pdo, $name, $email, $hashedPassword);
        // Take last ID user added
        $userid = $pdo->lastInsertId();
        addUserRole($pdo, $userid);

        // SESSION
        $_SESSION['loggedin'] = 'Y';
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['roles'] = ['user'];

        header('location: ../../user/index.php');
        exit;

    } catch (PDOException $e){
        $output = 'Database error: ' . $e->getMessage();
    }

} else {
    ob_start();
    include 'templates/signup.html';
    $output = ob_get_clean();
}

