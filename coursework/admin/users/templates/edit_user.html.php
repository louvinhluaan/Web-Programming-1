<body class="container mt-5">
    <h2>Edit User</h2>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">User ID</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['id']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="../manageusers.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>