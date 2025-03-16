<?php
$is_logged_in = isset($_COOKIE['user_id']);
$cart_count = 0; // Initialize cart count

if ($is_logged_in) {
    require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
    $user_id = $_COOKIE['user_id'];
    
    // Get user data
    $stmt = $conn->prepare("SELECT first_name, last_name, image FROM user WHERE id = ?");
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get cart count
    $sql = "SELECT COUNT(ci.id) AS item_count
            FROM cart_item ci
            JOIN cart c ON ci.cart_id = c.id
            WHERE c.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row) {
        $cart_count = $row['item_count'];
    }
}
?>
<style>
.dropdown-menu {
    min-width: 260px;
    max-width: 90vw;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,.08);
    box-shadow: 0 4px 16px rgba(0,0,0,.1);
}

@media (max-width: 991.98px) {
    .dropdown-menu {
        position: fixed !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        top: auto !important;
        transform: none !important;
        width: 100% !important;
        margin: 0;
        border-radius: 1rem 1rem 0 0;
        border-bottom: 0;
        max-width: 100%;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .auth-btn {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }
}
.auth-icon {
    font-size: 2rem;
    color: #0078d4;
    margin-bottom: 0.5rem;
}
.auth-btn {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    border-radius: 4px;
    width: 100%;
    margin-bottom: 0.5rem;
    transition: all 0.2s ease;
}
.auth-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,.1);
}
.profile-image {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

@media (max-width: 991.98px) {
    .profile-image {
        width: 28px;
        height: 28px;
    }
}
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="./index.php">
            <img src="/public/Main-Logo.svg" alt="site icon">
        </a>

        <!-- Mobile Button Group -->
        <div class="order-lg-2 nav-btns d-lg-none">
            <button type="button" class="btn position-relative" title="Search" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </button> 
            <?php if ($is_logged_in): ?>
                <button type="button" class="btn position-relative" title="Cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge bg-primary"><?php echo $cart_count; ?></span>
                </button>
            <?php endif; ?>
            <!-- Mobile Profile Dropdown -->
            <div class="dropdown d-inline-block">
                <button class="btn p-0" type="button" id="mobileProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if ($is_logged_in): ?>
                        <img src="/uploads/user/<?= $user_data['image'] ?: 'null.png' ?>" alt="Profile" class="profile-image">
                    <?php else: ?>
                        <i class="fa fa-user"></i>
                    <?php endif; ?>
                </button>
                <div class="dropdown-menu mobile-dropdown" aria-labelledby="mobileProfileDropdown">
                    <?php if ($is_logged_in): ?>
                        <div class="text-center">
                            <i class="bi bi-person-circle auth-icon"></i>
                            <h6 class="mb-2">Hello, <?= htmlspecialchars($user_data['first_name']) ?></h6>
                            <p class="text-muted small mb-3">Welcome back!</p>
                            <div class="d-grid gap-2">
                                <a href="./pages/profile.php" class="btn btn-outline-primary auth-btn">
                                    <i class="bi bi-person-circle me-2"></i>My Profile
                                </a>
                                <a href="./pages/OrderHistory.php" class="btn btn-outline-primary auth-btn">
                                    <i class="bi bi-clock-history me-2"></i>Order History
                                </a>
                                <a href="./pages/logout.php" class="btn btn-light auth-btn">
                                    <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center">
                            <i class="bi bi-person-circle auth-icon"></i>
                            <h6 class="mb-2">Welcome Guest</h6>
                            <p class="text-muted small mb-3">Please sign in to continue</p>
                            <div class="d-grid gap-2">
                                <a href="./pages/signin.php" class="btn btn-primary auth-btn">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                                </a>
                                <a href="./pages/signup.php" class="btn btn-outline-primary auth-btn">
                                    <i class="bi bi-person-plus me-2"></i>Sign Up
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
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
            <form class="d-none d-lg-flex me-lg-3" role="search" action="/index.php" method="GET">
                <input type="hidden" name="page" value="search">
                <input class="form-control me-2" type="search" name="q" placeholder="Search products..." aria-label="Search">
                <button class="btn btn-outline-primary" type="submit" title="Search">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- Desktop Button Group -->
            <div class="order-lg-2 nav-btns d-none d-lg-flex align-items-center">
                <?php if ($is_logged_in): ?>
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
                    global $conn;
                    // Get cart items count for logged in user
                    $cart_count = 0;
                    $user_id = $_COOKIE['user_id'];
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
                    <button type="button" class="btn position-relative" title="History" onclick="window.location.href='./pages/OrderHistory.php'">
                        <i class="fas fa-history fa-lg"></i>
                    </button>
                    <button type="button" class="btn position-relative" title="Cart" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-primary">
                            <?php echo $cart_count; ?>
                        </span>
                    </button>
                <?php endif; ?>
                <!-- Desktop Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if ($is_logged_in): ?>
                            <img src="/uploads/user/<?= $user_data['image'] ?: 'null.png' ?>" alt="Profile" class="profile-image">
                        <?php else: ?>
                            <i class="fa fa-user fa-lg"></i>
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown">
                        <?php if ($is_logged_in): ?>
                            <div class="text-center">
                                <h6 class="mb-2">Hello, <?= htmlspecialchars($user_data['first_name']) ?></h6>
                                <p class="text-muted small mb-3">Welcome back!</p>
                                <div class="d-grid gap-2">
                                    <a href="./pages/profile.php" class="btn btn-outline-primary auth-btn">
                                        <i class="bi bi-person-circle me-2"></i>My Profile
                                    </a>
                                    <a href="./pages/logout.php" class="btn btn-light auth-btn">
                                        <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="text-center">
                                <i class="bi bi-person-circle auth-icon"></i>
                                <h6 class="mb-2">Welcome Guest</h6>
                                <p class="text-muted small mb-3">Please sign in to continue</p>
                                <a href="./pages/signin.php" class="btn btn-primary auth-btn">
                                    <i class="bi bi-box-arrow-in-right me-1"></i>Sign In
                                </a>
                                <a href="./pages/signup.php" class="btn btn-light auth-btn">
                                    <i class="bi bi-person-plus me-1"></i>Sign Up
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Search Modal for Mobile -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Search Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/index.php" method="GET">
                    <input type="hidden" name="page" value="search">
                    <div class="input-group">
                        <input type="search" class="form-control" name="q" placeholder="Search products...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Cart Modal -->
<?php
// Get cart count and items before rendering the modal
if ($is_logged_in) {
    $sql = "SELECT COUNT(ci.id) AS item_count 
            FROM cart_item ci 
            JOIN cart c ON ci.cart_id = c.id 
            WHERE c.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $count_result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count_result && $count_result['item_count'] > 0) {
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
            $total += $item['UP'] * $item['quantity'];
        }
    }
}
?>

<style>
.cart-modal .modal-content {
    border: none;
    border-radius: 8px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
}

.cart-modal .modal-header {
    background: #fff;
    border-bottom: 1px solid #edebe9;
    padding: 16px 24px;
}

.cart-modal .modal-title {
    color: #323130;
    font-size: 20px;
    font-weight: 600;
}

.cart-modal .modal-body {
    padding: 24px;
}

.cart-item-card {
    border: 1px solid #edebe9;
    border-radius: 4px;
    margin-bottom: 12px;
    transition: all 0.2s ease;
}

.cart-item-card:hover {
    border-color: #0078d4;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

.cart-item-checkbox {
    width: 20px;
    height: 20px;
    border: 1px solid #8a8886;
    border-radius: 4px;
}

.cart-item-checkbox:checked {
    background-color: #0078d4;
    border-color: #0078d4;
}

.cart-item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #edebe9;
}

.cart-quantity-control {
    max-width: 120px;
}

.cart-quantity-control .btn {
    border: 1px solid #8a8886;
    background: #fff;
    color: #323130;
    padding: 4px 12px;
}

.cart-quantity-control .btn:hover {
    background: #f3f2f1;
}

.cart-quantity-control input {
    border: 1px solid #8a8886;
    color: #323130;
    text-align: center;
    font-weight: 600;
}

.cart-summary-card {
    background: #faf9f8;
    border: none;
    border-radius: 4px;
    padding: 16px;
}

.btn-checkout {
    background: #0078d4;
    border: none;
    padding: 8px 16px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-checkout:hover {
    background: #106ebe;
}

.btn-checkout:disabled {
    background: #f3f2f1;
    color: #a19f9d;
}

.cart-remove-btn {
    color: #d83b01;
    border: none;
    background: transparent;
    padding: 4px 8px;
    border-radius: 4px;
}

.cart-remove-btn:hover {
    background: #fde7e9;
}

.empty-cart-message {
    padding: 48px 24px;
    text-align: center;
    color: #605e5c;
}

.empty-cart-icon {
    font-size: 48px;
    color: #8a8886;
    margin-bottom: 16px;
}
</style>

<div class="modal fade cart-modal" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">
                    <i class="ms-Icon ms-Icon--ShoppingCart me-2"></i>Shopping Cart
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if ($is_logged_in && $count_result['item_count'] > 0): ?>
                    <div class="cart-items-container">
                        <?php foreach ($cart_items as $item): ?>
                            <div class="cart-item-card p-3" id="cart-item-<?= $item['cart_item_id'] ?>">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <input type="checkbox" class="cart-item-checkbox" 
                                               data-id="<?= $item['cart_item_id'] ?>"
                                               data-price="<?= $item['UP'] ?>"
                                               data-quantity="<?= $item['quantity'] ?>">
                                    </div>
                                    <img src="/uploads/product/<?= htmlspecialchars($item['image']) ?>" 
                                         class="cart-item-image me-3" 
                                         alt="<?= htmlspecialchars($item['name']) ?>">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-1 text-muted">Unit Price: Rs. <?= number_format($item['UP'], 2) ?></p>
                                                <p class="mb-0 text-primary">Subtotal: Rs. <?= number_format($item['UP'] * $item['quantity'], 2) ?></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="cart-quantity-control input-group me-3">
                                                    <button class="btn" type="button" onclick="updateCartQuantity(<?= $item['cart_item_id'] ?>, 'decrease')">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <input type="text" class="form-control" value="<?= $item['quantity'] ?>" readonly>
                                                    <button class="btn" type="button" onclick="updateCartQuantity(<?= $item['cart_item_id'] ?>, 'increase')">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                                <button class="cart-remove-btn" onclick="removeFromCart(<?= $item['cart_item_id'] ?>)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart-summary-card mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="mb-1">Total Amount</h6>
                                <small class="text-muted"><?= $count_result['item_count'] ?> items</small>
                            </div>
                            <h4 class="mb-0 text-primary">Rs. <?= number_format($total, 2) ?></h4>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="window.location.href='/index.php?page=product'">
                                Continue Shopping
                            </button>
                            <button class="btn btn-primary btn-checkout" id="proceedCheckoutBtn" disabled>
                                <i class="bi bi-credit-card me-2"></i>Proceed to Checkout
                            </button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="empty-cart-message">
                        <i class="bi bi-cart-x empty-cart-icon d-block"></i>
                        <h4 class="mb-3"><?= $is_logged_in ? 'Your cart is empty' : 'Please sign in first' ?></h4>
                        <p class="text-muted mb-4">
                            <?= $is_logged_in ? 'Browse our products and add some items to your cart!' : 'You need to sign in to view your cart' ?>
                        </p>
                        <a href="<?= $is_logged_in ? '/index.php?page=product' : '/pages/signin.php' ?>" class="btn btn-primary">
                            <i class="bi <?= $is_logged_in ? 'bi-shop' : 'bi-box-arrow-in-right' ?> me-2"></i>
                            <?= $is_logged_in ? 'Continue Shopping' : 'Sign In' ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Add this new function at the top of your script section
function updateHeaderCartCount(count) {
    // Update all cart count badges in the header
    document.querySelectorAll('.badge').forEach(badge => {
        badge.textContent = count;
    });
}

// Add this function to handle cart updates
function addToCart(itemId, userId) {
    fetch('/ajax/cart_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=add&item_id=${itemId}&user_id=${userId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count in header
            updateHeaderCartCount(data.cart_count);
            // Show success message or perform other actions
        } else {
            alert(data.message || 'Failed to add item to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to add item to cart');
    });
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    fetch('/handlers/cart-handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=count'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateHeaderCartCount(data.count);
        }
    });
    
    // Remove existing event listeners since Bootstrap's dropdown handles the toggling
    
    // Initialize all dropdowns using Bootstrap's built-in functionality
    var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });

    // Optional: Close dropdowns on scroll
    window.addEventListener('scroll', function() {
        dropdownList.forEach(function(dropdown) {
            dropdown.hide();
        });
    });

    // The rest of your cart and other functions remain unchanged
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
            const cartItem = document.getElementById(`cart-item-${cartItemId}`);
            const quantityInput = cartItem.querySelector('input[type="text"]');
            quantityInput.value = data.newQuantity;
            
            // Update subtotal
            const unitPriceText = cartItem.querySelector('.text-muted').textContent;
            const unitPrice = parseFloat(unitPriceText.split('Rs. ')[1].replace(/,/g, ''));
            const subtotal = unitPrice * data.newQuantity;
            cartItem.querySelector('.text-primary').textContent = `Subtotal: Rs. ${subtotal.toFixed(2)}`;
            
            // Update cart total and header count
            updateCartTotal();
            updateHeaderCartCount(data.cartCount);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update quantity');
    });
}

function updateCartItemsCount() {
    fetch('/handlers/cart-handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=count'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all cart count badges
            document.querySelectorAll('.badge').forEach(badge => {
                badge.textContent = data.count;
            });
        }
    });
}

function removeFromCart(cartItemId) {
    if(confirm('Are you sure you want to remove this item from cart?')) {
        fetch('/handlers/remove-cart-item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cart_item_id=${cartItemId}`
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Remove item from cart visual
                const cartItem = document.getElementById(`cart-item-${cartItemId}`);
                cartItem.remove();
                
                // Update cart count first
                updateCartItemsCount();
                
                // Check remaining items
                const cartItems = document.querySelectorAll('[id^="cart-item-"]');
                if (cartItems.length === 0) {
                    const modalBody = document.querySelector('#cartModal .modal-body');
                    modalBody.innerHTML = `
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                            <h4 class="mt-3">Your cart is empty</h4>
                            <p class="text-muted mb-4">Browse our products and add some items to your cart!</p>
                            <button class="btn btn-primary" data-bs-dismiss="modal" onclick="window.location.href='/index.php?page=product'">
                                <i class="bi bi-shop me-2"></i>Continue Shopping
                            </button>
                        </div>
                    `;
                } else {
                    // Only update total if there are remaining items
                    updateCartTotal();
                }
            } else {
                alert('Error: ' + (data.error || 'Could not remove item'));
            }
        });
    }
}

function updateCartTotal() {
    const cartItems = document.querySelectorAll('.cart-item-card');
    let total = 0;
    let itemCount = 0;

    cartItems.forEach(item => {
        const subtotalText = item.querySelector('.text-primary').textContent;
        const subtotal = parseFloat(subtotalText.split('Rs. ')[1].replace(/,/g, ''));
        if (!isNaN(subtotal)) {
            total += subtotal;
            itemCount++;
        }
    });

    // Update total amount in cart summary
    const totalElement = document.querySelector('.cart-summary-card h4.text-primary');
    if (totalElement) {
        totalElement.textContent = `Rs. ${total.toFixed(2)}`;
    }

    // Update item count in cart summary
    const itemCountElement = document.querySelector('.cart-summary-card small.text-muted');
    if (itemCountElement) {
        itemCountElement.textContent = `${itemCount} items`;
    }
}

// Call updateCartItemsCount when cart items change
document.addEventListener('DOMContentLoaded', function() {
    // ...existing code...
    
    // Setup cart count update on cart changes
    const cartObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                updateCartItemsCount();
            }
        });
    });

    const cartModalBody = document.querySelector('#cartModal .modal-body');
    if (cartModalBody) {
        cartObserver.observe(cartModalBody, { childList: true, subtree: true });
    }
});

// Add these functions to your existing script
document.addEventListener('DOMContentLoaded', function() {
    // ...existing code...
    
    // Add event listeners for checkboxes
    const cartCheckboxes = document.querySelectorAll('.cart-item-checkbox');
    cartCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateCheckoutButton);
    });

    // Update checkout button state
    function updateCheckoutButton() {
        const checkedItems = document.querySelectorAll('.cart-item-checkbox:checked');
        const checkoutBtn = document.getElementById('proceedCheckoutBtn');
        checkoutBtn.disabled = checkedItems.length === 0;
    }

    // Modify checkout button click handler
    document.getElementById('proceedCheckoutBtn').addEventListener('click', function() {
        const selectedItems = [...document.querySelectorAll('.cart-item-checkbox:checked')].map(cb => cb.dataset.id);
        
        if (selectedItems.length === 0) {
            alert('Please select items to checkout');
            return;
        }
        
        window.location.href = 'pages/ordersummary.php?items=' + selectedItems.join(',');
    });
});
// ...existing code...
</script>