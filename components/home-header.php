<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/cart.php';
// Assuming you have a session variable to check if the user is logged in
session_start();
$is_logged_in = isset($_COOKIE['user_id']);
if (isset($_COOKIE['user_id'])) {
    $user = new User($_COOKIE['user_id']);
    $cart = new Cart($user -> getCartId());
}
?>
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
            <button type="button" class="btn position-relative" title="User" id="profileButton">
                <i class="fa fa-user"></i>
            </button>
            <!-- Profile Pop-up Menu -->
            <div id="profileMenu" class="dropdown-menu">
                <?php if ($is_logged_in): ?>
                    <a class="dropdown-item" href="./pages/profile.html"><i class="bi bi-person-circle"></i> Profile</a>
                    <a class="dropdown-item" href="./pages/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                <?php else: ?>
                    <div class="dropdown-item text-center">
                        <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                        <p class="mt-2">Welcome! Please <a href="/pages/signin.php" class="text-primary">Sign In</a> or <a href="/pages/signup.php" class="text-primary">Sign Up</a> to continue.</p>
                    </div>
                <?php endif; ?>
            </div>
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
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary"><?php echo isset($cart) && $cart->getNoOfItems() ? $cart->getNoOfItems() : 0; ?></span>
                </button>
                <button type="button" class="btn position-relative" title="User" id="profileButtonDesktop">
                    <i class="fa fa-user"></i>
                </button>
                <!-- Profile Pop-up Menu for Desktop -->
                <div id="profileMenuDesktop" class="dropdown-menu">
                    <?php if ($is_logged_in): ?>
                        <a class="dropdown-item" href="./pages/profile.html"><i class="bi bi-person-circle"></i> Profile</a>
                        <a class="dropdown-item" href="./pages/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    <?php else: ?>
                        <div class="dropdown-item text-center">
                            <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                            <p class="mt-2">Welcome! Please <a href="./pages/signin.php" class="text-primary">Sign In</a> or <a href="./pages/signup.php" class="text-primary">Sign Up</a> to continue.</p>
                        </div>
                    <?php endif; ?>
                </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileButton = document.getElementById('profileButton');
    const profileMenu = document.getElementById('profileMenu');

    const profileButtonDesktop = document.getElementById('profileButtonDesktop');
    const profileMenuDesktop = document.getElementById('profileMenuDesktop');

    profileButton.addEventListener('click', function() {
        profileMenu.classList.toggle('show');
        adjustDropdownPosition(profileMenu);
    });

    profileButtonDesktop.addEventListener('click', function() {
        profileMenuDesktop.classList.toggle('show');
        adjustDropdownPosition(profileMenuDesktop);
    });

    document.addEventListener('click', function(event) {
        if (!profileButton.contains(event.target) && !profileMenu.contains(event.target)) {
            profileMenu.classList.remove('show');
        }
        if (!profileButtonDesktop.contains(event.target) && !profileMenuDesktop.contains(event.target)) {
            profileMenuDesktop.classList.remove('show');
        }
    });

    window.addEventListener('scroll', function() {
        profileMenu.classList.remove('show');
        profileMenuDesktop.classList.remove('show');
    });

    function adjustDropdownPosition(menu) {
        const rect = menu.getBoundingClientRect();
        if (rect.right > window.innerWidth) {
            menu.style.left = 'auto';
            menu.style.right = '0';
        } else {
            menu.style.left = '';
            menu.style.right = '';
        }
    }
});
</script>