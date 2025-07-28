<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }

    /* Sidebar desktop */
    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #212529;
      padding-top: 1rem;
      color: white;
    }

    .sidebar a {
      color: white;
      padding: 12px 20px;
      display: block;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #343a40;
    }

    /* Main content */
    .main-content {
      margin-left: 250px;
      padding: 20px;
    }

    /* Responsive override: collapse sidebar on mobile */
    @media (max-width: 767.98px) {
      .sidebar {
        display: none;
      }
      .main-content {
        margin-left: 0;
      }
    }

    /* Ellipsis for table */
    .table td:nth-child(2) {
      max-width: 200px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
</head>
<body>

  <!-- Top navbar (only shown on mobile) -->
  <nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
      <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
        <i class="bi bi-list"></i>
      </button>
      <span class="navbar-brand mb-0">Forum Admin</span>
    </div>
  </nav>

  <!-- Sidebar for desktop -->
  <div class="sidebar d-none d-md-block">
    <h4 class="text-center">Forum Admin</h4>
    <a href="\COMP1841\coursework\admin\admin_dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <a href="\COMP1841\coursework\admin\managequestions.php"><i class="bi bi-question-circle me-2"></i>Manage Questions</a>
    <a href="\COMP1841\coursework\admin\manageusers.php"><i class="bi bi-people me-2"></i>Manage Users</a>
    <a href="\COMP1841\coursework\admin\managemodules.php"><i class="bi bi-journal-bookmark me-2"></i>Manage Modules</a>
    <a href="\COMP1841\coursework\admin\contactmessages.php"><i class="bi bi-envelope-at me-2"></i>Contact Messages</a>
    <a href="\COMP1841\coursework\user\index.php"><i class="bi bi-box-arrow-right me-2"></i>Public Site</a>
  </div>

  <!-- Offcanvas sidebar for mobile -->
  <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Forum Admin</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
      <a href="admin_dashboard.php" class="d-block px-3 py-2 text-white text-decoration-none"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
      <a href="managequestions.php" class="d-block px-3 py-2 text-white text-decoration-none"><i class="bi bi-question-circle me-2"></i>Manage Questions</a>
      <a href="manageusers.php" class="d-block px-3 py-2 text-white text-decoration-none"><i class="bi bi-people me-2"></i>Manage Users</a>
      <a href="managemodules.php" class="d-block px-3 py-2 text-white text-decoration-none"><i class="bi bi-journal-bookmark me-2"></i>Manage Modules</a>
      <a href="contactmessages.php" class="d-block px-3 py-2 text-white text-decoration-none"><i class="bi bi-envelope-at me-2"></i>Contact Messages</a>
      <a href="../user/index.php" class="d-block px-3 py-2 text-white text-decoration-none"><i class="bi bi-box-arrow-right me-2"></i>Public Site</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <?= $output ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
