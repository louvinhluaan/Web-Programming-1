<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="card-title mb-4 text-center">Create an Account</h3>
        
        <!-- Alert-->
        <div class="mt-3">
            <?php include '../../include/alert.php'; ?>
        </div>  

        <form action="../signup.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <div class="col-auto">
              <span id="passwordHelpInline" class="form-text">
                Must be 8-20 characters long.
              </span>
            </div>            
          </div>

          <div class="mb-3">
            <label for="password_again" class="form-label">Confirm Password</label>
            <input type="password" name="password_again" id="password_again" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>

        <div class="text-center mt-3">
          <small>Already have an account? <a href="login.html.php">Log In</a></small>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
