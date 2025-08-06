<?php
    include '../../../system/login/check.php';
    include '../../../system/include/DatabaseConnection.php';
    include '../../../system/include/DatabaseFunction.php';       
    try {
        $title = 'User Profile';

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('Invalid user ID');
        }

        $userId = (int) $_GET['id'];
        $user = getUserById($pdo, $userId);

        if (!$user) {
            die('User not found');
        }

        // Get number of questions asked by user
        $totalQuestions = getQuestionsAskedByUser($pdo, $userId);

        // Get recent questions by user
        $userQuestions = getRecentQuestions($pdo, $userId);

        // Get recent answers by user
        $userAnswers = getRecentAnswers($pdo, $userId);

        // Badges
        $badges = ['Gold', 'Silver', 'Bronze'];
        
        $totalAnswers = count($userAnswers);
        $totalBadges = count($badges);
        ob_start();
        include 'templates/view_profile.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include '../../templates/public_layout.html.php';