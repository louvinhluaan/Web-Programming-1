<?php
session_start();
if(isset($_POST['name'])){
    try{
        include '../include/DatabaseConnection.php';

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $passwordAgain = $_POST['password_again'];

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email không hợp lệ.");
        }

        // Check matching password
        if ($password !== $passwordAgain) {
            throw new Exception("Mật khẩu xác nhận không khớp.");
        }        

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add new user
        $sql = 'INSERT INTO user SET
                `name` = :name,
                email = :email,
                `password` = :password';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->execute();

        // Take last ID user added
        $userid = $pdo->lastInsertId();

        // Add role 'user' to new user
        $roleSql = 'INSERT INTO userrole SET userid = :userid, roleid = 2';
        $roleStmt = $pdo->prepare($roleSql);
        $roleStmt->bindValue(':userid', $userid);
        $roleStmt->execute();        

        // Logged in
        $_SESSION['loggedin'] = 'Y';
        $_SESSION['userid'] = $userid;
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['roles'] = ['user'];

        header('location: ../../user/index.php');
        exit;

    } catch (PDOException $e){
        if ($e->getCode() == 23000) {
            echo "<script>alert('Email da ton tai')</script>
            <script>window.location = 'templates/signup.html.php'</script>";
            // header("Location: templates/signup.html");
        } else {
            $output = 'Database error: ' . $e->getMessage();
        }
    }

} else {
    ob_start();
    include 'templates/signup.html';
    $output = ob_get_clean();
}

