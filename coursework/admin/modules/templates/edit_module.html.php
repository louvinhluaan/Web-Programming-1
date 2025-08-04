<body class="container mt-5">
  <h2>Edit Module</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Module Name</label>
      <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($module['name']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Module</button>
    <a href="../managemodules.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>