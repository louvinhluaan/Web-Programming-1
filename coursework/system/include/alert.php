<?php if (isset($_SESSION['upload_error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <?= htmlspecialchars($_SESSION['upload_error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['upload_error']); ?>
<?php endif; ?>
