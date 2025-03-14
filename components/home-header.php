<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/classes/user.php';
// Assuming you have a session variable to check if the user is logged in
session_start();
$is_logged_in = isset($_COOKIE['user_id']);
if (isset($_COOKIE['user_id'])) {
    $user = new User($_COOKIE['user_id']);
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
            <?php if ($is_logged_in): ?>
                <button type="button" class="btn position-relative" title="Order History" onclick="window.location.href='./pages/OrderHistory.php'">
                    <i class="fas fa-history"></i>
                </button>
                <button type="button" class="btn position-relative" title="Cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">5</span>
                </button>
            <?php endif; ?>
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
                <?php if ($is_logged_in): ?>
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
                    global $conn;
                    // Get cart items count for logged in user
                    $cart_count = 0;
                    $user_id = $_COOKIE['user_id'];
                    require_once 'context/connect.php';
                    $sql = "SELECT COUNT(ci.id) AS item_count
                            FROM cart_item ci
                            JOIN cart c ON ci.cart_id = c.id
                            WHERE c.user_id = ?;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(1, $user_id, PDO::PARAM_INT); 
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($row) {
                        $cart_count = $row['item_count'];
                    }
                    ?>
                    <button type="button" class="btn position-relative" title="History" onclick="window.location.href='./pages/OrderHistory.html'">
                        <i class="fas fa-history fa-lg"></i>
                    </button>
                    <button type="button" class="btn position-relative" title="Cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">
                            <?php echo $cart_count; ?>
                        </span>
                    </button>
                <?php endif; ?>
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
                <?php
                if ($is_logged_in) {
                    $user_id = $_COOKIE['user_id'];
                    // First get the cart items count
                    $sql = "SELECT COUNT(ci.id) AS item_count 
                           FROM cart_item ci 
                           JOIN cart c ON ci.cart_id = c.id 
                           WHERE c.user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $count_result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($count_result['item_count'] > 0) {
                        // Get cart items details
                        $sql = "SELECT i.name, i.image, i.UP, ci.quantity, ci.id as cart_item_id
                               FROM cart_item ci 
                               JOIN cart c ON ci.cart_id = c.id
                               JOIN item i ON ci.item_id = i.id
                               WHERE c.user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
                        $stmt->execute();
                        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $total = 0;

                        foreach ($cart_items as $item) {
                            $subtotal = $item['UP'] * $item['quantity'];
                            $total += $subtotal;
                            ?>
                            <div class="row mb-3 align-items-center">
                                <div class="col-2">
                                    <img src="/assets/img/products/<?= htmlspecialchars($item['image']) ?>" 
                                         class="img-fluid rounded" alt="<?= htmlspecialchars($item['name']) ?>">
                                </div>
                                <div class="col-4">
                                    <p class="mb-0 fw-bold"><?= htmlspecialchars($item['name']) ?></p>
                                    <p class="mb-0">Rs. <?= number_format($item['UP'], 2) ?></p>
                                    <p class="mb-0">Subtotal: Rs. <?= number_format($subtotal, 2) ?></p>
                                </div>
                                <div class="col-3 d-flex align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm me-2" 
                                            onclick="updateCartQuantity(<?= $item['cart_item_id'] ?>, 'decrease')">-</button>
                                    <input type="number" class="form-control form-control-sm text-center" 
                                           value="<?= $item['quantity'] ?>" style="width: 50px;" readonly>
                                    <button class="btn btn-outline-secondary btn-sm ms-2" 
                                            onclick="updateCartQuantity(<?= $item['cart_item_id'] ?>, 'increase')">+</button>
                                </div>
                                <div class="col-2 text-center">
                                    <button class="btn btn-danger btn-sm" 
                                            onclick="removeFromCart(<?= $item['cart_item_id'] ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Total: Rs. <?= number_format($total, 2) ?></h5>
                            <button class="btn btn-primary" onclick="window.location.href='/pages/checkout.php'">
                                Proceed to Checkout
                            </button>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                            <h4 class="mt-3">Your cart is empty</h4>
                            <p class="text-muted">Browse our products and add some items to your cart!</p>
                            <button class="btn btn-primary" data-bs-dismiss="modal">Continue Shopping</button>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="text-center py-5">
                        <i class="bi bi-person-x" style="font-size: 3rem;"></i>
                        <h4 class="mt-3">Please sign in first</h4>
                        <p class="text-muted">You need to sign in to view your cart</p>
                        <a href="/pages/signin.php" class="btn btn-primary">Sign In</a>
                    </div>
                    <?php
                }
                ?>
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

function updateCartQuantity(cartItemId, action) {
    fetch('/api/cart/update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            cartItemId: cartItemId,
            action: action
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    });
}

function removeFromCart(cartItemId) {
    if (confirm('Are you sure you want to remove this item?')) {
        fetch('/api/cart/remove.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                cartItemId: cartItemId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message);
            }
        });
    }
}
</script>