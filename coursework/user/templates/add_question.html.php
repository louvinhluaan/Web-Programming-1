<div class="container mt-5">
  <h2 class="mb-4">Ask a Question</h2>
  <form action="add_question.php" method="post" enctype="multipart/form-data">
    
    <div class="mb-3">
      <label for="quest_title" class="form-label">Title</label>
      <input type="text" name="quest_title" class="form-control" id="quest_title" required>
    </div>  

    <div class="mb-3">
      <label for="questtext" class="form-label">Type your question here:</label>
      <textarea name="questtext" class="form-control" id="questtext" rows="4" required></textarea>
    </div>

    <div class="row mb-3">
      <!-- Select Module -->
      <div class="col">
        <label for="modules" class="form-label">Module</label>
        <select name="modules" id="modules" class="form-select" required>
          <option value="">Select a module</option>
          <?php foreach ($modules as $module): ?>
            <option value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
              <?= htmlspecialchars($module['name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- User -->
      <div class="col">
            <input type="hidden" name="users" value="<?= $_SESSION['userid']; ?>">
      </div>
    </div>

    <!-- Upload Image -->
    <div class="mb-3">
      <label for="fileToUpload" class="form-label">Add your image (Optional):</label>
      <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
    </div>

    <!-- Alert-->
    <div class="mt-3">
        <?php include '../system/include/alert.php'; ?>
    </div>  

    <button type="submit" name="submit" class="btn btn-primary">Add</button>
  </form>
</div>