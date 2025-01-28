<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Sola Chemicals - Home</title>

    <!-- metadata -->
    <?php include './components/metadata.html'; ?>

    <!-- for seo optimization
    <meta name="robots" content="index, follow"/>
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="https://hashcoders.alwaysdata.net/"/>
    -->

    <link rel="stylesheet" href="/assets/css/style.css">
  </head>
  <body>

    <!-- navbar -->
    <?php include './components/home-header.php'; ?>

    <!-- Dynamic Content -->
    <div class="content">
      <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        if ($page == 'about') {
          include './pages/about.php';
        } elseif ($page == 'product') {
          include './pages/product.php';
        }else {
          include './pages/home.php';
        }
      ?>
    </div>

    <!-- navbar -->
    <?php include './components/home-footer.php'; ?>

    <script src="/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/script.js"></script>
  </body>
</html>
