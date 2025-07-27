<?php
    require 'C:/xampp/htdocs/COMP1841/coursework/system/login/check.php';
    $activeTab = 'home';
    $title = 'Home - GSQF';
    ob_start();
    include 'templates/public_home.html.php';
    $output = ob_get_clean();
    include 'templates/public_layout.html.php';