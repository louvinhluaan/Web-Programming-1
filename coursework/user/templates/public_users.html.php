<style>
    .card-link .card {
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .card-link:hover .card {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        transform: translateY(-4px);
    }
</style>

<div class="container pb-5">
  <h2 class="mb-4">Users</h2>
  <form class="mb-4" method="get" action="">
    <input type="text" name="search" class="form-control" placeholder="Search users by name...">
  </form>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
    <?php foreach ($users as $user): ?>
      <div class="col">
        <a href="tabs/users_tab/view_profile.php?id=<?= $user['id'] ?>" class="card-link text-decoration-none text-dark">
            <div class="card text-center h-100 shadow-sm p-4">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=0d6efd&color=fff" 
                    width="60" 
                    height="60" 
                    class="rounded-circle mx-auto mb-3" 
                    alt="Avatar of <?= htmlspecialchars($user['name']) ?>">

                <h5 class="card-title"><?= htmlspecialchars($user['name']) ?></h5>
                <p class="text-muted mb-1">Joined: <?= date('M d, Y', strtotime($user['created_at'])) ?></p>
            </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>




