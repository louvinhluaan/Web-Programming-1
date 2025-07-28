<style>
  .module-card:hover {
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    transition: 0.2s;
    cursor: pointer;
  }

  .card-link:hover .card {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    transform: translateY(-4px);
  }
</style>

<div class="container pb-5">
  <h2 class="mb-4">Modules</h2>

  <!-- Search Bar -->
  <form class="mb-4" method="get" action="">
    <input type="text" name="search" class="form-control" placeholder="Search modules...">
  </form>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
    <?php foreach ($modules as $module): ?>
      <div class="col">
        <a href="tabs/modules_tab/view_module.php?id=<?= $module['id'] ?>" class="card-link text-decoration-none text-dark">
          <div class="card module-card h-100 p-4 shadow-sm">
            <div class="card-body text-center">
              <h5 class="card-title"><?= htmlspecialchars($module['name']) ?></h5>
              <p class="card-text small text-muted"><?= htmlspecialchars($module['description']) ?></p>
              <p class="small text-secondary"><?= $module['total_questions'] ?> Questions</p>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>