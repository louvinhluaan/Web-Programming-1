<?php
session_start();
if ($_SESSION["loggedin"] != "Y") {
    header("Location: /COMP1841/coursework/system/login/templates/login.html.php");
}
