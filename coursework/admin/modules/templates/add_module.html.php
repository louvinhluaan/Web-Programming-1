<body class="container mt-5">
  <h2>Add Module</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Module Name</label>
      <input name="name" type="text" class="form-control" placeholder="e.g. COMP1841" required>
    </div>
    <button type="submit" class="btn btn-success">Add Module</button>
    <a href="manage_modules.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
