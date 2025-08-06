<body class="container mt-5">
  <h2>Add Module</h2>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Module Name</label>
      <input name="name" type="text" class="form-control" placeholder="e.g. COMP1841" required>
      <div class="mt-2 mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" placeholder="e.g. This is a subject about..." rows="3"></textarea>
      </div>
    </div>
    <button type="submit" class="btn btn-success">Add Module</button>
    <a href="../managemodules.php" class="btn btn-secondary">Cancel</a>
  </form>
</body>
