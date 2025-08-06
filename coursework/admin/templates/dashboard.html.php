<!-- Title and Admin Status -->
<div style="display: flex; justify-content: space-between; align-items: center; padding: 20px;">
    <h2>Admin Dashboard</h2>
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
    <!-- Questions --->
    <div class="col-md-4">
    <div class="card text-white bg-info">
        <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title">Total Questions</h5>
            <h3><?= count($questions) ?></h3>
        </div>
        <i class="bi bi-question-circle card-icon fs-2"></i>
        </div>
    </div>
    </div>

    <!-- Users --->
    <div class="col-md-4">
    <div class="card text-white bg-primary">
        <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title">Total Users</h5>
            <h3><?= count($users) ?></h3>
        </div>
        <i class="bi bi-people card-icon fs-2"></i>
        </div>
    </div>
    </div>

    <!-- Modules --->
    <div class="col-md-4">
    <div class="card text-white bg-success">
        <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title">Modules</h5>
            <h3><?= count($modules) ?></h3>
        </div>
        <i class="bi bi-journal-bookmark card-icon fs-2"></i>
        </div>
    </div>
    </div>
</div>

<!-- Manage Questions Table -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
    <h5 class="mb-0">Recent Questions</h5>
    <a href="managequestions.php" class="btn btn-sm btn-primary">View All</a>
    </div>
    <div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Questions</th>
            <th>User</th>
            <th>Module</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
          <?php $recentQuestions = array_slice($questions, 0, 5); ?>
          <?php foreach ($recentQuestions as $index => $q): ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td>
                <div class="text-truncate" style="max-width: 200px;">
                    <?= htmlspecialchars($q['quest_title']) ?>
                </div>
              </td>
              <td class="text-truncate" style="max-width: 100px;">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($q['user_name']) ?>&background=0d6efd&color=fff" 
                    width="24" 
                    height="24" 
                    class="rounded-circle me-1">
                <?= htmlspecialchars($q['user_name']) ?>
              </td>
              <td><?= htmlspecialchars($q['module_name']) ?></td>
              <td><?= date('M d, Y \a\\t h:i A', strtotime($q['questdate'])) ?></td>
              <td>
                <a href="questions/adm_viewquestion.php?id=<?= $q['id'] ?>" class="btn btn-sm btn-outline-primary mb-md-1">View</a>
                <a href="questions/adm_deletequestion.php?id=<?= $q['id'] ?>" class="btn btn-sm btn-outline-danger mb-1"
                   onclick="return confirm('Delete this question and all its answers?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
