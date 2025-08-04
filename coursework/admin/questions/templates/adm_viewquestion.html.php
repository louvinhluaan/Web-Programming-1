<!DOCTYPE html>
<html>
<head>
  <title>View Question</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h2>Question Detail</h2>

  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title"><?= htmlspecialchars($question['questtext']) ?></h5>
      <p class="card-text">
        <strong>User:</strong> <?= htmlspecialchars($question['user_name']) ?><br>
        <strong>Module:</strong> <?= htmlspecialchars($question['module_name']) ?><br>
        <strong>Date:</strong> <?php $display_date = date("M d, Y \a\\t h:i A", strtotime($question['questdate']))?>   
                    <?=htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8')?>
      </p>

      <?php if (!empty($question['images'])): ?>
        <img src="../../user/images/<?= htmlspecialchars($question['images']) ?>" alt="Question Image" class="img-fluid mt-3 rounded border" style="max-height: 300px;">
      <?php endif; ?>
    </div>
  </div>

  <?php if (count($answers) > 0): ?>
    <h4>Answers</h4>
    <?php foreach ($answers as $a): ?>
      <div class="card mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="d-block" style="max-width: 100%; word-break: break-word;">
                          <?= htmlspecialchars($a['answer_text']) ?>
                    </span>
                    <small class="text-muted">By <?= htmlspecialchars($a['user_name']) ?> • <?php $display_date = date("M d, Y \a\\t h:i A", strtotime($a['created_at']))?>   
                    <?=htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8')?></small>
                </div>
                <a href="delete_answer.php?id=<?= $a['id'] ?>&qid=<?= $question['id'] ?>" 
                    class="btn btn-sm btn-outline-danger ms-3"
                    onclick="return confirm('Delete this answer?');">Delete</a>
            </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-muted">No answers yet.</p>
  <?php endif; ?>

  <a href="../managequestions.php" class="btn btn-secondary mt-3">Back</a>
</body>
</html>