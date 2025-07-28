<body>
    <div class="container pb-5">
    <a href="view_profile.php?id=<?= $user_id ?>" class="btn btn-outline-secondary mb-4">← Back to Profile</a>
    <div class="card p-4">
        <h3 class="mb-4">Edit Profile</h3>

        <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" rows="4" class="form-control"><?= htmlspecialchars($user['bio']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    </div>
</body>
