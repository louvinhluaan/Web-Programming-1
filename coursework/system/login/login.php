<?php
session_start();
include '../include/DatabaseConnection.php';
include '../include/DatabaseFunction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user
    $user = checkEmail($pdo, $email);

    if (!$user) {
        $_SESSION['error'] = 'Wrong email. Try again.';
        header("Location: templates/login.html.php");
        exit();
    }

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = 'Y';
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        $roles = getUserRoles($pdo, $user['id']);
        $_SESSION['roles'] = $roles;

        if(in_array('admin', $_SESSION['roles'])) {
            header("Location: ../../admin/admin_dashboard.php");
            exit();
        }
        else {
            header("Location: ../../user/index.php");
            exit();
        }

    } else {
        $_SESSION['error'] = 'Wrong password. Try again.';
        header("Location: templates/login.html.php");
        exit();
    }
} else {
        $_SESSION['error'] = 'Login failed. Try again.';
        header("Location: templates/login.html.php");
        exit();
}


