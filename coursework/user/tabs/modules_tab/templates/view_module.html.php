<div class="container pb-5">
  <h2 class="mb-4">Module: <?= htmlspecialchars($module['name']) ?></h2>


  <?php if (count($questions)): ?>
    <ul class="list-group">
      <?php foreach ($questions as $q): ?>
        <li class="list-group-item">
          <a href="../../view_question.php?id=<?= $q['id'] ?>" class="text-decoration-none fw-bold">
            <span class="d-block text-truncate" style="max-width: 100%;">
              <?= htmlspecialchars($q['quest_title']) ?>
            </span>
          </a>
          <div class="small text-muted mt-1">
            Asked by <?= htmlspecialchars($q['user_name']) ?> • <?= date('M d, Y \a\t h:i A', strtotime($q['questdate'])) ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p class="text-muted">No questions available in this module yet.</p>
  <?php endif; ?>
</div>
