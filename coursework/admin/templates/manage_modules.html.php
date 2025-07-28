<!-- Title and Admin Status -->
<div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
    <h2>Manage Modules</h2>
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


<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">Total Modules</h5>
                <h3><?= count($modules) ?></h3>
            </div>
            <i class="bi bi-journal-bookmark card-icon fs-2"></i>
            </div>
        </div>
    </div>
</div>

<a href="modules/add_module.php" class="btn btn-success mb-3">+ Add Module</a>


<!-- Manage Modules Table -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Modules</h5>
    </div>
    <div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Module Name</th>
            <th>Created At</th>
            <th>Questions</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($modules as $index => $module): ?>    
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($module['name']) ?></td>
            <td><?= date('M d, Y \a\\t h:i A', strtotime($module['created_at'])) ?></td>
            <td><span class="badge bg-success"><?= $module['question_count'] >= 2 ? $module['question_count'] . ' questions' : $module['question_count'] . ' question' ?></span></td>
            <td>
                <a href="modules/edit_module.php?id=<?= $module['id'] ?>" class="btn btn-sm btn-outline-primary mb-md-1">Edit</a>
                <a href="modules/delete_module.php?id=<?= $module['id'] ?>" class="btn btn-sm btn-outline-danger mb-1" 
                    onclick="return confirm('This will also delete all questions in this module. Are you sure?');">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
