<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Sola Chemicals - Home</title>

    <!-- For meta data -->
    <?php include "./components/metadata.html" ?>
    
    <!--      For SEO
    <meta name="robots" content="index, follow"/>
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
    <link rel="canonical" href="https://hashcoders.alwaysdata.net/"/>
    -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>

    <!-- navbar -->
    <?php include './components/header.php'; ?>

    <!-- Dynamic Content -->
    <div class="content">
      <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        if ($page == 'about') {
          include './pages/about.php';
        } elseif ($page == 'product') {
          include './pages/product.php';
        } else {
          include './pages/home.php';
        }
      ?>
    </div>

    <!-- navbar -->
    <?php include './components/home-footer.php'; ?>

    <script src="/sola-chemicals-ecommerce-platform/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/script.js"></script>
  </body>
</html>
