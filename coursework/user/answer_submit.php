    <?php
    session_start();
    include '../system/include/DatabaseConnection.php';

    $question_id = $_POST['question_id'] ?? null;
    $answer_text = $_POST['answer_text'] ?? null;

    // Xác định user_name
    if (isset($_SESSION['userid'])) {
        // Lấy tên user từ DB
        $user_id = $_SESSION['userid'];
        $stmt = $pdo->prepare("SELECT name FROM user WHERE id = ?");
        $stmt->execute([$_SESSION['userid']]);
        $row = $stmt->fetch();
        $user_name = $row ? $row['name'] : 'Ẩn danh';
    } else {
        // Trường hợp không đăng nhập, dùng tên từ input form
        $user_name = $_POST['user_name'] ?? null;
    }

    if (!$question_id || !$answer_text || !$user_name) {
        die('Thiếu dữ liệu.');
    }

    // Ghi câu trả lời vào bảng answers
    $sql = "INSERT INTO answers (user_id, question_id, answer_text, user_name, created_at) 
            VALUES (?, ?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $question_id, $answer_text, $user_name]);

    // Quay lại view câu hỏi
    header("Location: view_question.php?id=" . $question_id);
    exit;
