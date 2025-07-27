<?php
session_start();
if ($_SESSION["loggedin"] != "Y") {
    header("Location: ../system/login/templates/login.html.php");
}