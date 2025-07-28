<div class="container my-5">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong><?= htmlspecialchars($question['module_name']) ?></strong>
        </div>
        <div class="card-body">
            <p><?= nl2br(htmlspecialchars($question['questtext'])) ?></p>

            <?php if (!empty($question['images'])): ?>
                <img src="images/<?= htmlspecialchars($question['images']) ?>" class="img-fluid mt-3" style="max-height: 300px;" alt="Question Image">
            <?php endif; ?>

            <p class="text-muted mt-3">
                Asked by <a class="text-decoration-none" href="tabs/users_tab/view_profile.php?id=<?=$question['userid']?>">
                            <?=htmlspecialchars($question['user_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                • <?php $display_date = date("M d, Y \a\\t h:i A", strtotime($question['questdate']))?>   
                <?=htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8')?>
            </p>
            
            <?php if (in_array('admin', $_SESSION['roles']) || $_SESSION['userid'] == $question['userid']): ?>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <!-- Button Edit -->
                    <a href="editquestion.php?id=<?= $question['id'] ?>" class="btn btn-primary me-md-1">Edit</a>
                    <!-- Button Delete -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletequestion">
                        Delete
                    </button>
                    <!-- Modal For Delete Question -->
                    <div class="modal fade" id="deletequestion" tabindex="-1" aria-labelledby="deleteQuestionLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteQuestionLabel">Delete Question</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete this question?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="deletequestion.php?id=<?= $question['id'] ?>" class="btn btn-danger">Delete</a>
                        </div>
                        </div>
                    </div>
                    </div>                
                </div>
            <?php endif;?>
        </div>
    </div>

    <h4 class="mb-3">Answers</h4>
    <?php if (!empty($answers)): ?>
        <?php foreach ($answers as $answer): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p><?= nl2br(htmlspecialchars($answer['answer_text'])) ?></p>
                    <p class="text-muted mb-0">
                        Answer by 
                        <a class="text-decoration-none" href="tabs/users_tab/view_profile.php?id=<?=$answer['user_id']?>">
                            <?=htmlspecialchars($answer['user_name'], ENT_QUOTES, 'UTF-8'); ?>
                        </a> 
                        • <?php $display_date = date("M d, Y \a\\t h:i A", strtotime($answer['created_at']))?>   
                        <?=htmlspecialchars($display_date, ENT_QUOTES, 'UTF-8')?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">No answers yet.</p>
    <?php endif; ?>

    <hr>

    <h4 class="mt-4 mb-3">Submit Your Answer</h4>
    <form action="answer_submit.php" method="POST">
        <?php if (isset($_SESSION['loggedin'])): ?>
            <input type="hidden" name="userid" value="<?= $_SESSION['userid'] ?>">
        <?php endif; ?>
        
        <input type="hidden" name="question_id" value="<?= $question['id'] ?>">

        <div class="mb-3">
            <label for="answer_text" class="form-label">Your Response</label>
            <textarea class="form-control" id="answer_text" name="answer_text" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Submit Answer</button>
    </form>
</div>
