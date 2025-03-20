<?php
session_start();
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Sola Chemicals - Home</title>

    <!-- metadata -->
    <?php require_once './components/metadata.html'; ?>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/assets/css/profile.css" rel="stylesheet" />
  </head>
  <body>

    <!-- navbar -->
    <?php require_once './components/home-header.php'; ?>

    <!-- Dynamic Content -->
    <div class="content">
      <?php
      $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'home';
      $allowed_pages = ['home', 'about', 'product', 'ProductOverview', 'search','findNeatByOutleat', 'profile'];
      if (in_array($page, $allowed_pages)) {
        require_once "./pages/{$page}.php";
      } else {
        require_once './pages/home.php';
      }
      ?>
    </div>

    <!-- navbar -->
    <?php require_once './components/home-footer.php'; ?>

    <script src="/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/script.js"></script>
  </body>
</html>
