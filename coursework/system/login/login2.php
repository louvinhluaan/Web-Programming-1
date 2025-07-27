<?php
session_start();
if (isset($_POST['email'])) {
try{
    include '../include/DatabaseConnection.php';
    $sql = 'SELECT id, `name`, email, `password` FROM user
        WHERE email = :email';
    
    $s = $pdo->prepare($sql);
    $s->bindValue(':email', $_POST['email']);
    $s->execute();
    $user = $s->fetch();
}
catch (PDOException $e){
    $output = 'Database error: ' . $e->getMessage();
}
    if ($user && password_verify($_POST['password'], $user['password'])) 
    {
        $_SESSION['loggedin'] = 'Y';
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['email'] = $user['email'];

        $sql = 'SELECT role.name FROM `role`
                INNER JOIN userrole ON role.id = userrole.roleid
                WHERE userrole.userid = :userid';
        $s = $pdo->prepare($sql);
        $s->bindValue(':userid', $user['id']);
        $s->execute();
        $roles = $s->fetchAll();

        $roleNames = array_column($roles, 'name');

        $_SESSION['roles'] = $roleNames;

        if(in_array('admin', $roleNames)) {
            $email = $_POST['email'];
            echo "<script>alert('Welcome Admin!, $email')</script>
				<script>window.location = '../../admin/admin_forum.php'</script>";
            // header('Location: ../admin/forum.php');
        } else {
            $email = $_POST['email'];
            echo "<script>alert('Welcome User!, $email')</script>
				<script>window.location = '../../user/index.php'</script>";
            // header("Location: ../index.php");
        }
        exit;
    }
    else
    {
        echo "<script>alert('Invalid email or password')</script>
				<script>window.location = 'templates/login.html'</script>";
    }
}else{
    ob_start();
    include 'templates/login.html';
    $output = ob_get_clean();
}


