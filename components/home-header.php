<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="./index.php">
            <img src="./public/Main-Logo.svg" alt="site icon">
        </a>

        <!-- Mobile Button Group -->
        <div class="order-lg-2 nav-btns d-lg-none">
            <button type="button" class="btn position-relative" title="Search">
                <i class="fa fa-search"></i>
            </button>
            <button type="button" class="btn position-relative" title="Favorites">
                <i class="fa fa-heart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">2</span>
            </button>
            <button type="button" class="btn position-relative" title="Cart">
                <i class="fa fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
            </button>
            <button type="button" class="btn position-relative" title="User">
                <i class="fa fa-user"></i>
            </button>
        </div>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" title="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-lg-1" id="navMenu">
            <!-- Left-Aligned Navigation Links -->
            <ul class="navbar-nav me-auto text-start">
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="./index.php?page=home">Home</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="./index.php?page=about">About</a>
                </li>
                <li class="nav-item px-2 py-2">
                    <a class="nav-link text-uppercase text-dark" href="./index.php?page=product">Product</a>
                </li>
            </ul>

            <!-- Search Box for Larger Screens -->
            <form class="d-none d-lg-flex me-lg-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit" title="Search">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- Desktop Button Group -->
            <div class="order-lg-2 nav-btns d-none d-lg-block">
                <button type="button" class="btn position-relative" title="Favorites">
                    <i class="fa fa-heart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">2</span>
                </button>
                <button type="button" class="btn position-relative" title="Cart">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
                </button>
                <button type="button" class="btn position-relative" title="User">
                    <i class="fa fa-user"></i>
                </button>
            </div>
        </div>
    </div>
  </nav>