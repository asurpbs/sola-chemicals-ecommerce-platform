<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="./index.php">
            <img src="/public/Main-Logo.svg" alt="site icon">
        </a>

        <!-- Mobile Button Group -->
        <div class="order-lg-2 nav-btns d-lg-none">
            <button type="button" class="btn position-relative" title="Search">
                <i class="fa fa-search"></i>
            </button>
            <button type="button" class="btn position-relative" title="History" onclick="window.location.href='./pages/OrderHistory.html'">
                <i class="fas fa-history"></i>
            </button>
            <button type="button" class="btn position-relative" title="Cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="fa fa-shopping-cart"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
            </button>
            <button type="button" class="btn position-relative" title="User" data-bs-toggle="modal" data-bs-target="#signupModal">
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
                <button type="button" class="btn position-relative" title="History" onclick="window.location.href='./pages/OrderHistory.html'">
                    <i class="fas fa-history fa-lg"></i>
                </button>
                <button type="button" class="btn position-relative" title="Cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
                </button>
                <button type="button" class="btn position-relative" title="User" data-bs-toggle="modal" data-bs-target="#signupModal">
                <i class="fa fa-user"></i>
            </button>
            </div>
        </div>
    </div>
  </nav>

  <!-- Cart Modal -->
  <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Your Cart</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Cart Items -->
                            <div class="row mb-3 align-items-center">
                                <div class="col-2">
                                    <!-- Product Image -->
                                    <img src="https://via.placeholder.com/80" class="img-fluid rounded" alt="Product">
                                </div>
                                <div class="col-4">
                                    <!-- Product Name -->
                                    <p class="mb-0 fw-bold">Item Name</p>
                                </div>
                                <div class="col-3 d-flex align-items-center">
                                    <!-- Quantity Controls -->
                                    <button class="btn btn-outline-secondary btn-sm me-2">-</button>
                                    <input type="number" class="form-control form-control-sm text-center" value="1" style="width: 50px;">
                                    <button class="btn btn-outline-secondary btn-sm ms-2">+</button>
                                </div>
                                <div class="col-2 text-center">
                                    <!-- Remove Button -->
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                            <!-- Repeat for more items -->
                            <hr>
                            <!-- Total & Checkout -->
                            <div class="text-end">
                                <button class="btn btn-primary">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Modal -->
     <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Already have an account? <a href="./pages/signIn.html" class="text-primary">Sign in here</a>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="signUpButton">Sign Up</button>
                </div>
                <script>
                    document.getElementById('signUpButton').addEventListener('click', function() {
                        window.location.href = './pages/signUp.html';
                    });
                </script>
                </div>
            </div>
        </div>
    </div>