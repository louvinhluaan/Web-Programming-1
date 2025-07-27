<?php
session_start();
include '../include/DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = 'Y';
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        $roles = getUserRoles($pdo, $user['id']);
        $_SESSION['roles'] = $roles;

        if (in_array('admin', $roles)) {
            header("Location: ../../user/index.php");
        } else {
            header("Location: ../../user/index.php");
        }
        exit();
    } else {
        header("Location: login.php?error=Invalid+credentials");
        exit();
    }
}

function getUserRoles($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT role.name FROM role 
        JOIN userrole ON role.id = userrole.roleid 
        WHERE userrole.userid = :userid");
    $stmt->execute([':userid' => $userId]);
    return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'name');
}
