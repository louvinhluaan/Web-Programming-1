<body class="container mt-5">
  <h2>Edit Module</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Module Name</label>
      <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($module['name']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Module</button>
    <a href="../managemodules.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>