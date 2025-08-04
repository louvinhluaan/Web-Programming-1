<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="card-title mb-4 text-center">Log In</h3>

        <!-- Alert-->
        <div class="mt-3">
            <?php include '../../include/alert.php'; ?>
        </div> 

        <form action="../login.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>

        <div class="text-center mt-3">
          <small>Don't have an account? <a href="signup.html.php">Sign Up</a></small>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
