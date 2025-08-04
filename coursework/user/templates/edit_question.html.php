<div class="container mt-5">
    <h2 class="mb-4">Edit Question</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($question['id']) ?>">

        <!-- Question Text -->
        <div class="mb-3">
            <label for="questtext" class="form-label">Your question:</label>
            <textarea class="form-control" id="questtext" name="questtext" rows="4" required><?= htmlspecialchars($question['questtext']) ?></textarea>
        </div>

        <!-- User & Module Select -->
        <div class="row">
            <!-- Module Select -->
            <div class="col-md-6 mb-3">
                <label for="moduleid" class="form-label">Module</label>
                <select class="form-select" name="moduleid" id="moduleid" required>
                    <option disabled>Select a module</option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module['id'] ?>" <?= $module['id'] == $question['moduleid'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($module['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- User -->
            <div class="col-md-6 mb-3">
                <label for="userid" class="form-label">
                    User: <strong><?= htmlspecialchars($question['user_name'], ENT_QUOTES, 'UTF-8') ?></strong>
                </label>
            </div>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label for="images" class="form-label">Edit your image (Optional):</label>
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
            <?php if ($question['images']): ?>
                <p class="mt-2">Current image:</p>
                <img src="images/<?= htmlspecialchars($question['images']) ?>" alt="Current Image" class="img-fluid mt-2" style="max-height: 150px;">
            <?php endif; ?>
        </div>

        <!-- Alert-->
        <div class="mt-3">
            <?php include '../system/include/alert.php'; ?>
        </div>  

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
            <a href="view_question.php?id=<?=$question['id']?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

