<?php 
    include '../../../system/login/check.php';
    try {
        include '../../../system/include/DatabaseConnection.php';
        include '../../../system/include/DatabaseFunction.php';      

        $title = 'User Profile';

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('Invalid user ID');
        }

        $userId = (int) $_GET['id'];

        // Get user details
        $stmt = $pdo->prepare("SELECT id, name, email, created_at, bio FROM user WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die('User not found');
        }

        // Get number of questions asked by user
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM question WHERE userid = :id");
        $stmt->execute([':id' => $userId]);
        $totalQuestions = $stmt->fetchColumn();

        // Get recent questions by user
        $questionStmt = $pdo->prepare("SELECT id, questtext, questdate FROM question WHERE userid = :id ORDER BY questdate DESC LIMIT 5");
        $questionStmt->execute([':id' => $userId]);
        $userQuestions = $questionStmt->fetchAll();

        // Get recent answers by user
        $answerStmt = $pdo->prepare("SELECT answers.id, answers.answer_text, answers.created_at, question.questtext, question_id
            FROM answers
            JOIN question ON answers.question_id = question.id
            WHERE answers.user_id = :id
            ORDER BY answers.created_at DESC
            LIMIT 5");
        $answerStmt->execute([':id' => $userId]);
        $userAnswers = $answerStmt->fetchAll();

        // Badges
        $badges = ['Gold', 'Silver', 'Bronze'];

        $totalAnswers = count($userAnswers);
        $totalBadges = count($badges);
        ob_start();
        include 'templates/view_profile.html.php';
        $output = ob_get_clean();
    } catch (PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error: ' . $e ->getMessage();
    }
    
    include '../../templates/public_layout.html.php';