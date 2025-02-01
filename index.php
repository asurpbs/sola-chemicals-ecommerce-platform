<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Sola Chemicals - Home</title>

    <!-- metadata -->
    <?php require_once './components/metadata.html'; ?>

    <link rel="stylesheet" href="/assets/css/style.css">
  </head>
  <body>

    <!-- navbar -->
    <?php require_once './components/home-header.php'; ?>
z
    <!-- Dynamic Content -->
    <div class="content">
      <?php
      $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'home';
      $allowed_pages = ['home', 'about', 'product'];
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
