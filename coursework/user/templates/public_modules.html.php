<style>
    .border-hover:hover {
        border-color: #929497ff;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
    }
</style>

<div class="container my-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
        <?php foreach ($modules as $module): ?>
            <div class="col">
                <a href="#?name=<?= urlencode($module['name']); ?>" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-hover">
                        <div class="card-body text-center text-secondary">
                            <h5 class="card-title"><?= htmlspecialchars($module["name"], ENT_QUOTES, 'UTF-8'); ?></h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
