<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Sola Chemicals - Home</title>
    <?php include './data/meta.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/style.css">
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
      <div class="container">
          <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="index.html">
              <img src="img/Main-Logo.svg" alt="site icon">
          </a>

          <!-- Mobile Button Group -->
          <div class="order-lg-2 nav-btns d-lg-none">
              <button type="button" class="btn position-relative">
                  <i class="fa fa-search"></i>
              </button>
              <button type="button" class="btn position-relative">
                  <i class="fa fa-heart"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">2</span>
              </button>
              <button type="button" class="btn position-relative">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
              </button>
              <button type="button" class="btn position-relative">
                  <i class="fa fa-user"></i>
              </button>
          </div>

          <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse order-lg-1" id="navMenu">
              <!-- Left-Aligned Navigation Links -->
              <ul class="navbar-nav me-auto text-start">
                  <li class="nav-item px-2 py-2">
                      <a class="nav-link text-uppercase text-dark" href="#">Home</a>
                  </li>
                  <li class="nav-item px-2 py-2">
                      <a class="nav-link text-uppercase text-dark" href="about-us.html">About</a>
                  </li>
                  <li class="nav-item px-2 py-2">
                      <a class="nav-link text-uppercase text-dark" href="product.html">Product</a>
                  </li>
              </ul>

              <!-- Search Box for Larger Screens -->
              <form class="d-none d-lg-flex me-lg-3" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-primary" type="submit">
                      <i class="fa fa-search"></i>
                  </button>
              </form>

              <!-- Desktop Button Group -->
              <div class="order-lg-2 nav-btns d-none d-lg-block">
                  <button type="button" class="btn position-relative">
                      <i class="fa fa-heart"></i>
                      <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">2</span>
                  </button>
                  <button type="button" class="btn position-relative">
                      <i class="fa fa-shopping-cart"></i>
                      <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
                  </button>
                  <button type="button" class="btn position-relative">
                      <i class="fa fa-user"></i>
                  </button>
              </div>
          </div>
      </div>
    </nav>
  <!-- end of navbar -->

    <!-- Hero Section -->
    <section>
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/banner4.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/banner4.jpg"  alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/banner4.jpg" alt="Third slide">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    <!-- Welcome Section -->
    <section class="py-5 text-center">
      <div class="container">
        <h1>Welcome to <span class="highlight-red">Sola Chemicals</span></h1>
        <p class="fs-4">We Provide <span class="highlight-red">House hold</span> Chemicals For your <span class="highlight-blue">Home</span></p>
        <p class="mt-3">
          Sola Chemical Company: Sri Lanka's Trusted Cleaning Solutions Provider (Since 2010). We cater to all your cleaning needs, offering a comprehensive selection of household and commercial cleaning solutions.
        </p>

        <div class="row mt-5 text-center">
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle"><img src="img/vision.png" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Vision</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle"><img src="img/Mission.png" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Mission</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="d-flex flex-column align-items-center">
              <div class="circle"><img src="img/service.png" alt="Vision Icon" class="circle"></div>
              <h4 class="text-primary">Services</h4>
            </div>
          </div>
        </div>

        <div class="mt-5">
          <h3>Legacy of clean</h3>
          <p class="fs-5">
            Sola Chemicals: Making your home sparkle and your life easier! We offer high-quality cleaning chemicals, washing powders & liquids, air fresheners, hand washes, and dish wash.
          </p>
        </div>

        <!-- Stats Section -->
        <div class="row text-center mt-4">
          <div class="col-sm-3">
            <div class="stat-box">
              <h3>15</h3>
              <p>Years <br> of reliability</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="stat-box">
              <h3>99%</h3>
              <p>of products <br> manufactured locally</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="stat-box">
              <h3>+25</h3>
              <p>of outlets <br> island wide</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="stat-box">
              <h3>+25000</h3>
              <p>retailer reach <br> island wide</p>
            </div>
          </div>
        </div>

        <div class="mt-5">
          <a href="findNeatByOutleat.html">
            <button class="btn btn-primary">Use My Location</button>
          </a>
        </div>
      </div>
    </section>



    <!-- Horizontal Scrolling Products Section -->
    <section id="products" class="py-5 bg-light">
      <div class="container">
        <h3 class="text-center mb-4">Our Products</h3>
        <div class="product-container d-flex gap-3 overflow-scroll">
          <!-- Individual Product Card -->
          <div class="card flex-shrink-0" style="width: 200px;">
            <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\42.jpg" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\43.jpg" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\44.jpg" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\45.jpg" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
              <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\46.jpg" class="card-img-top" alt="Product">
          </div>
          <div class="card flex-shrink-0" style="width: 200px;">
            <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\46.jpg" class="card-img-top" alt="Product">
        </div>
        <div class="card flex-shrink-0" style="width: 200px;">
          <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\46.jpg" class="card-img-top" alt="Product">
      </div>
      <div class="card flex-shrink-0" style="width: 200px;">
        <img src="C:\Users\Chamal Jayawardana\Desktop\projects\sola img\46.jpg" class="card-img-top" alt="Product">
      </div>
      </div>
    </section>

    <!-- Why Use Sola Chemicals Section -->
    <section class="why-use-section py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-5">Why Choose Sola Chemicals?</h2>
        <div class="row text-center d-flex justify-content-center">
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="img/Sustainable products.jpg" alt="Sustainable Products">
              <h5>Sustainable Products</h5>
              <p>Explore our carefully curated selection of sustainable products, each designed to reduce your carbon footprint</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="img/Eco-Friendly.png" alt="Eco-Friendly Choices">
              <h5>Eco-Friendly Choices</h5>
              <p>Make conscious choices with our eco-friendly products, knowing that your purchases promote ethical sourcing and responsible manufacturing practices.</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="img/High-quality.png" alt="High-Quality Selection">
              <h5>High-Quality Selection</h5>
              <p>Invest in long-lasting and reliable products that meet our stringent quality standards, ensuring your satisfaction and the longevity of your purchases.</p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="why-choose-item">
              <img src="img/Su-Packaging.png" alt="Sustainable Packaging">
              <h5>Sustainable Packaging</h5>
              <p>Our sustainable packaging ensures that your orders arrive safely while minimizing their impact on the planet.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

  <!-- Reviews Section -->
  <section class="reviews-section py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5">Customer Reviews</h2>
      <div class="row text-center">
        <!-- Review 1 -->
        <div class="col-sm-4">
          <div class="review-box p-4">
            <div class="review-author d-flex justify-content-center">
              <img src="path/to/customer1.jpg" alt="Chamod" class="customer-image">
            </div>
            <div class="review-stars">
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
            </div>
            <p class="review-text">"Sola Chemicals provided excellent service with sustainable products. Highly recommend!"</p>
            <p class="review-author-name">Chamod Abeywickramage</p>
          </div>
        </div>
        <!-- Review 2 -->
        <div class="col-sm-4">
          <div class="review-box p-4">
            <div class="review-author d-flex justify-content-center">
              <img src="path/to/customer2.jpg" alt="Chamal Jayawardana" class="customer-image">
            </div>
            <div class="review-stars">
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
            </div>
            <p class="review-text">"Great products that are both eco-friendly and affordable. Will purchase again!"</p>
            <p class="review-author-name">Chamal Jayawardana</p>
          </div>
        </div>
        <!-- Review 3 -->
        <div class="col-sm-4">
          <div class="review-box p-4">
            <div class="review-author d-flex justify-content-center">
              <img src="path/to/customer3.jpg" alt="Mihiranga Chathum" class="customer-image">
            </div>
            <div class="review-stars">
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
              <span class="star">★</span>
            </div>
            <p class="review-text">"Excellent quality, fast delivery, and great customer service. Very satisfied!"</p>
            <p class="review-author-name">Mihiranga Chathum</p>
          </div>
        </div>
      </div>
    </div>
  </section>



    <!-- Footer -->
    <footer class="bg-dark text-white py-4 text-center">
      <p>Copyright © 2025. All Rights Reserved.</p>
    </footer>
    <?php include './data/bootstrap.php'; ?>
    <script src="/assets/js/script.js"></script>
  </body>
</html>
