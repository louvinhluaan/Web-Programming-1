<style>
}
</style>

<div class="container mt-4" style="max-width: 900px;">
  <div class="border-bottom pb-2 mb-4">
    <h3>Newest Questions</h5>
    <div class="d-flex justify-content-between align-items-center">
      <h6 class="mb-0 text-muted"><?= $totalQuestions ?> questions</h6>
      <a href="add_question.php" class="btn btn-primary">Ask Question</a>
  </div>
</div>

</div>
<?php foreach($questions as $question): ?>
    <?php
    // Count answers
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM answers WHERE question_id = ?");
    $stmt->execute([$question['id']]);
    $commentCount = $stmt->fetchColumn();
    ?>


    <div class="card my-4 shadow-sm" style="max-width: 700px; margin: auto;">
        <div class="card-body p-4">
            <!-- Title -->
            <h5 class="card-title fw-semibold mb-3">
                <div class="d-block text-truncate text-primary" style="max-width: 700px;">
                    <a href="view_question.php?id=<?= $question['id'] ?>" class="text-decoration-none text-primary">
                        <?=htmlspecialchars($question['questtext'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </div>
            </h5>                

            <!-- Description -->
            <p class="card-text text-secondary">
                Module <?=htmlspecialchars($question['module_name'], ENT_QUOTES, 'UTF-8'); ?>
            </p>

            <!-- Author and time -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <small class="text-muted d-inline-flex align-items-center" style="max-width: 100%;">
                      Asked by&nbsp;
                      <a class="text-decoration-none text-truncate d-inline-block me-1" 
                         style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                         href="tabs/users_tab/view_profile.php?id=<?=$question['userid']?>">
                         <?=htmlspecialchars($question['user_name'], ENT_QUOTES, 'UTF-8'); ?>
                      </a>
                        • <?php $display_date = date("M d, Y \a\\t h:i A", strtotime($question['questdate']))?>   
                      <?=htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8')?>
                    </small>
                </div>

                <!-- Action buttons -->
                <div>
                    <button class="btn btn-sm btn-outline-secondary">
                        <a class="text-decoration-none link-secondary" href="view_question.php?id=<?= $question['id'] ?>"><i class="bi bi-chat-dots me-1"></i> <?= $commentCount <= 1 ? $commentCount.' answer' : $commentCount.' answers' ?> </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<nav>
  <ul class="pagination justify-content-center">
    <!-- Previous -->
    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page - 1 ?>&keyword=<?= urlencode($keyword) ?>">Previous</a>
    </li>

    <?php
    $range = 2;
    if ($page > ($range + 2)) {
        echo '<li class="page-item"><a class="page-link" href="?page=1&keyword=' . urlencode($keyword) . '">1</a></li>';
        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
    }

    for ($i = max(1, $page - $range); $i <= min($totalPages, $page + $range); $i++): ?>
      <li class="page-item <?= $i === $page ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>"><?= $i ?></a>
      </li>
    <?php endfor;

    if ($page < $totalPages - ($range + 1)) {
        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '&keyword=' . urlencode($keyword) . '">' . $totalPages . '</a></li>';
    }
    ?>

    <!-- Next -->
    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page + 1 ?>&keyword=<?= urlencode($keyword) ?>">Next</a>
    </li>
  </ul>
</nav>
<?php endif; ?>


