<div class="container pb-5">
  <!-- User Info -->
  <div class="row justify-content-center mb-4">
    <div class="col-md-12">
      <div class="card p-3 text-center position-relative">
        
        <?php if ((isset($_SESSION['userid']) && $_SESSION['userid'] == $user['id'])): ?>
          <a href="edit_profile.php?id=<?= $user['id'] ?>" 
            class="btn btn-sm btn-outline-primary position-absolute top-0 end-0 m-3">
            Edit
          </a>
        <?php endif; ?>

      
        <h5 class="mb-3">Profile</h5>
      <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=0d6efd&color=fff" 
           class="rounded-circle mb-3 mb-3 d-block mx-auto"
           width="100" height="100"
           alt="Avatar of <?= htmlspecialchars($user['name']) ?>">

      <h3><?= htmlspecialchars($user['name']) ?></h3>
      <p class="text-muted mb-2"><strong>Joined:</strong> <?= date('M d, Y', strtotime($user['created_at'])) ?></p>
      <p><?= $user['bio'] ?></p>
      </div>
    </div>
  </div>

  <!-- Badges -->
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card p-3">
        <h5>Badges</h5>
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($badges as $badge): ?>
            <span class="badge bg-primary"><?= $badge ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats -->
  <div class="row mb-4">
    <div class="col-md-12">
      <div class="card p-3">
        <h5 class="mb-3">Stats</h5>
        <div class="d-flex flex-wrap gap-3">
          <div class="border rounded text-center px-4 py-2">
            <h4 class="mb-0"><?= $totalQuestions ?></h4>
            <small class="text-muted">Questions</small>
          </div>
          <div class="border rounded text-center px-4 py-2">
            <h4 class="mb-0"><?= $totalAnswers ?></h4>
            <small class="text-muted">Answers</small>
          </div>
          <div class="border rounded text-center px-4 py-2">
            <h4 class="mb-0"><?= $totalBadges ?></h4>
            <small class="text-muted">Badges</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Questions -->
  <div class="row g-4 mb-4">
    <div class="col-md-12">
      <div class="card p-3 h-100">
        <h5>Recent Questions</h5>
        <ul class="list-group list-group-flush">
          <?php if (count($userQuestions)): ?>
            <?php foreach ($userQuestions as $q): ?>
              <li class="list-group-item">
                <div>
                  <a href="../../view_question.php?id=<?= $q['id'] ?>" class="text-decoration-none">
                    <span class="d-block text-truncate" style="max-width: 100%;">
                      <?= htmlspecialchars($q['quest_title']) ?>
                    </span>
                  </a>
                </div>
                <small class="text-muted"><?= date('M d, Y \a\\t H:i A', strtotime($q['questdate'])) ?></small>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-muted">No questions yet.</li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

  <!-- Answers -->
  <div class="row g-4 mb-4">
    <div class="col-md-12">
      <div class="card p-3 h-100">
        <h5>Recent Answers</h5>
        <ul class="list-group list-group-flush">
          <?php if (count($userAnswers)): ?>
            <?php foreach ($userAnswers as $a): ?>
              <li class="list-group-item">
                <!-- Question Clickable -->
                <a href="../../view_question.php?id=<?= $a['question_id'] ?>" class="text-decoration-none">
                  <span class="d-block text-truncate" style="max-width: 100%;">    
                    <?= htmlspecialchars($a['quest_title']) ?>
                  </span>
                </a>
                <div class="ms-3 mt-2 p-2 bg-light border-3 rounded">
                  <span class="d-block text-truncate" style="max-width: 100%;"> 
                    <?= htmlspecialchars($a['answer_text']) ?>
                  </span>
                  <div class="text-muted small mt-1"><?= date('M d, Y \a\\t h:i A', strtotime($a['created_at'])) ?></div>
                </div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="list-group-item text-muted">No answers yet.</li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

