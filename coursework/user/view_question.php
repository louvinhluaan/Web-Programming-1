<?php
session_start();
include '../system/include/DatabaseConnection.php';
include '../system/include/DatabaseFunction.php';

$userName = null;
if (isset($_SESSION['userid'])) {
    $stmt = $pdo->prepare("SELECT name FROM user WHERE id = ?");
    $stmt->execute([$_SESSION['userid']]);
    $row = $stmt->fetch();
    $userName = $row['name'] ?? null;
}

$question_id = $_GET['id'] ?? null;
if (!$question_id || !is_numeric($question_id)) {
    die('Không tìm thấy câu hỏi.');
}

// Lấy câu hỏi + người đăng + module
$sql = "SELECT q.*, u.name AS user_name, email, m.name AS module_name 
        FROM question q
        LEFT JOIN user u ON q.userid = u.id
        LEFT JOIN module m ON q.moduleid = m.id
        WHERE q.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$question_id]);
$question = $stmt->fetch();

if (!$question) {
    die('Không có câu hỏi phù hợp.');
}

// Lấy danh sách câu trả lời (nếu có bảng answers)
$answers = [];
if (tableExists($pdo, 'answers')) {
    $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ? ORDER BY created_at DESC");
    $stmt->execute([$question_id]);
    $answers = $stmt->fetchAll();
}


// Tạo nội dung HTML vào $output
ob_start();

$title = 'View Question';

include 'templates/viewquestion.html.php';
$output = ob_get_clean();

// Gọi layout chính
include 'templates/public_layout.html.php';
