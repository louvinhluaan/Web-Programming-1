<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
        // To bold and underline the active tab
        $activeTab = $activeTab ?? '';
        $isActive = function (string $tab) use ($activeTab): string {
        return isset($activeTab) && $activeTab === $tab ? 'active' : '';
        };
    ?>
    <!--
        navbar-expand-lg: active reponsive collapsing
        bg-body-tertiary: bg color from boostrap
    -->
    <nav class="navbar navbar-expand-lg bg-body-secondary">
      <div class="container">
          <!--Logo-->
          <a class="navbar-brand" href="#">
              <img src="../system/logo/logo.png" alt="Logo" width="50" height="50">
          </a>

          <!--Toggler for small devices-->          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!--Navigation Tabs-->
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <!--  
                me-auto: margin right auto to make the searching placeholder to the right 
                mb-2: margin bottom = 0.5rem ($spacers * .5) to add mb when small devices
                mb-lg-0: margin bottom for large devices (>= 992px) = 0 to remove mb when large devices
            -->
            <div class="navbar-nav nav-underline me-auto mb-2 mb-lg-0">
                    <a class="nav-link <?= $isActive('adminforum') ?>" href="admin_forum.php">Manage Forum</a>
                    <a class="nav-link <?= $isActive('addquestion') ?>" href="addquestion.php">Add a new question</a>
                    <a class="nav-link <?= $isActive('users') ?>" href="admin_users.php">Manage Users</a>
                    <a class="nav-link <?= $isActive('admin') ?>" href="../user/index.php">Public Site</a>
            </div>

            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
              <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
          </div>
          
      </div>
    </nav>
    <main class="py-4">
        <div class="container bg-info-subtle">
            <?=$output?>
        </div>
    </main>
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-6">
                    <h3 class="pt-3 fw-bold">Lou Vinh Luan</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <p>djkadsjklgjsg</p>
                    <p class="mb-0">fkdjskglas</p>
                </div>
                <div class="col col">
                    <h4 class="pt-3 fw-bold">Menu</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-light">Home</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Forum</a></li>
                        <li><a href="#" class="text-decoration-none text-light">Users</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 text-lg-start">
                    <h4 class="pt-3 fw-bold">Follow Us</h4>
                    <div>
                        <a href="#" class="text-decoration-none text-light"><i class="bi bi-facebook fs-2 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-light"><i class="bi bi-instagram fs-2 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-light"><i class="bi bi-threads fs-2 me-2"></i></a>
                        <a href="#" class="text-decoration-none text-light"><i class="bi bi-linkedin fs-2"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <p>&copy; 2025 LouVinhLuan. All Rights Reserved.</p>
                <div class="d-flex">
                    <a href="#" class="text-decoration-none text-light me-3">Terms of use</a>
                    <a href="#" class="text-decoration-none text-light">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>