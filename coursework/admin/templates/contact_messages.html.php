<!-- Title and Admin Status -->
<div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
    <h2>Contact Messages</h2>
    <div class="dropdown">
        <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($adminName) ?>&background=0d6efd&color=fff" 
                width="36" 
                height="36" 
                class="rounded-circle">
            <span>Welcome, <strong><?= htmlspecialchars($adminName) ?></strong></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="../system/login/logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<hr>

<!-- Stats Card -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-warning bg-opacity-75">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Total Messages</h5>
                    <h3><?= count($messages) ?></h3>
                </div>
                <i class="bi bi-envelope-at card-icon fs-2"></i>
            </div>
        </div>
    </div>
</div>

<!-- Contact Messages Table -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Messages</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Sender</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $index => $msg): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td class="text-truncate" style="max-width: 100px;">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($msg['name']) ?>&background=0d6efd&color=fff" 
                            width="24" 
                            height="24" 
                            class="rounded-circle me-1">
                        <?= htmlspecialchars($msg['name']) ?>
                    </td>
                    <td><?= htmlspecialchars($msg['email']) ?></td>
                    <td style="max-width: 300px;" class="text-truncate"><?= htmlspecialchars($msg['message']) ?></td>
                    <td><?= date('M d, Y \a\\t h:i A', strtotime($msg['created_at'])) ?></td>
                    <td>
                        <a href="deletemessage.php?id=<?= $msg['id'] ?>" class="btn btn-sm btn-outline-danger mb-1" onclick="return confirm('Delete this message?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>