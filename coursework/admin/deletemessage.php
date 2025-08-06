<?php
include '../system/login/check.php';
include '../system/include/DatabaseConnection.php';
include '../system/include/DatabaseFunction.php';

if (isset($_GET['id'])) {
    deleteContactMessages($pdo, $_GET['id']);
}
header("Location: contactmessages.php");
exit();
