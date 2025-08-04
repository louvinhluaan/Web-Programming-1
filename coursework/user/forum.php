<?php
    include '../system/login/check.php';
    include '../system/include/DatabaseConnection.php';
    include '../system/include/DatabaseFunction.php';
    $activeTab = 'forum';
try {
    $title = 'Forum';
    $total = totalQuestions($pdo);

    // Pagination
    $limit = 5;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    $page = max(1, $page);
    $offset = ($page - 1) * $limit;    

    // Searching
    $keyword = $_GET['keyword'] ?? '';
    $questions = [];
    $totalQuestions = 0;

    if (!empty($keyword)) {
        $totalQuestions = countSearchResults($pdo, $keyword);
        $questions = searchQuestionsPaginated($pdo, $keyword, $limit, $offset);
    } else {
        $totalQuestions = totalQuestions($pdo);
        $questions = getAllQuestionsPaginated($pdo, $limit, $offset);
    }

    $totalPages = ceil($totalQuestions / $limit);   

    ob_start();
    include 'templates/public_forum.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/public_layout.html.php';
