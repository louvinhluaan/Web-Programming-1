<?php
    include '../system/login/check.php';
    
    $activeTab = 'home';
    $title = 'Home';


    ob_start();
    include 'templates/public_home.html.php';
    $output = ob_get_clean();
    include 'templates/public_layout.html.php';