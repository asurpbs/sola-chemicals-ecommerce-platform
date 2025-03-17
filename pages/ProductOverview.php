<?php
require $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
global $conn;

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    header("Location: index.php?page=product");
    exit();
}

// Fetch product details
$sql = "SELECT i.*, c.name as category_name 
        FROM item i 
        LEFT JOIN category c ON i.category_id = c.id 
        WHERE i.id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: index.php?page=product");
    exit();
}

// Get image path
$imagePath = "/uploads/product/" . ($product['image'] ? $product['image'] : 'default.png');
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
    $imagePath = "/uploads/product/null.png";
}
?>
<div class="bg-light py-5">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php?page=product" class="text-decoration-none">Products</a></li>
                <li class="breadcrumb-item"><?php echo htmlspecialchars($product['category_name']); ?></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['name']); ?></li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="bg-white p-5 product-image-container">
                        <img class="img-fluid rounded-3" src="<?php echo $imagePath; ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>" />
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ps-lg-4">
                    <h1 class="display-5 fw-bold mb-4"><?php echo htmlspecialchars($product['name']); ?></h1>
                    
                    <div class="pricing-section mb-4 p-4 bg-white rounded-4 shadow-sm">
                        <?php if ($product['discount_rate'] > 0): ?>
                            <div class="d-flex align-items-center gap-3">
                                <span class="h3 text-muted text-decoration-line-through mb-0">Rs.<?php echo number_format($product['UP'], 2); ?></span>
                                <span class="h2 text-danger fw-bold mb-0">Rs.<?php echo number_format($product['UP'] * (1 - $product['discount_rate']/100), 2); ?></span>
                                <span class="badge bg-danger rounded-pill px-3 py-2"><?php echo $product['discount_rate']; ?>% OFF</span>
                            </div>
                        <?php else: ?>
                            <span class="h2 fw-bold">Rs.<?php echo number_format($product['UP'], 2); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="product-info mb-4">
                        <div class="d-flex align-items-center p-4 bg-white rounded-4 shadow-sm">
                            <div class="d-flex align-items-center me-4">
                                <i class="bi bi-box-seam fs-4 text-primary me-2"></i>
                                <span class="fw-semibold">Stock Status:</span>
                                <?php if ($product['availability'] == '1' && $product['QoH'] > 0): ?>
                                    <span class="badge bg-success-subtle text-success ms-2 px-3 py-2 rounded-pill">
                                        In Stock (<?= $product['QoH'] ?> available)
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger ms-2 px-3 py-2 rounded-pill">
                                        Out of Stock
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php if (!empty($product['description'])): ?>
                            <div class="mt-4 p-4 bg-white rounded-4 shadow-sm">
                                <h6 class="fw-bold mb-3">Product Description</h6>
                                <div class="text-muted"><?php echo nl2br(htmlspecialchars($product['description'])); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($product['availability'] == '1' && $product['QoH'] > 0 && isset($_COOKIE['user_id'])): ?>
                        <div class="purchase-actions bg-white rounded-4 shadow-sm p-4 mt-4">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="input-group input-group-lg quantity-input" style="width: 160px;">
                                    <button class="btn btn-outline-primary px-3" type="button" onclick="changeQuantity(-1)">
                                        <i class="bi bi-dash-lg"></i>
                                    </button>
                                    <input type="number" class="form-control text-center fw-semibold quantity-control" id="quantity" 
                                           value="1" min="1" max="<?php echo $product['QoH']; ?>" readonly>
                                    <button class="btn btn-outline-primary px-3" type="button" onclick="changeQuantity(1)">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-lg px-4" type="button" onclick="addToCart()">
                                    <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                </button>
                                <button class="btn btn-danger btn-lg px-4" type="button" onclick="buyNow()">
                                    <i class="bi bi-lightning-fill me-2"></i>Buy Now
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <h2 class="display-6 fw-bold text-center mb-5">Related Products</h2>
    <div class="row g-4">
        <?php
        // Fetch related products from same category
        $sql = "SELECT * FROM item 
                WHERE category_id = ? AND id != ? 
                LIMIT 4";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product['category_id'], $product_id]);
        $related_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($related_products as $related): 
            $relatedImagePath = "/uploads/product/" . ($related['image'] ? $related['image'] : 'default.png');
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $relatedImagePath)) {
                $relatedImagePath = "/uploads/product/null.png";
            }
        ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm related-product-card">
                    <div class="position-relative">
                        <?php if ($related['discount_rate'] > 0): ?>
                            <div class="badge bg-danger position-absolute end-0 top-0 m-3 rounded-pill px-3">
                                <?php echo $related['discount_rate']; ?>% OFF
                            </div>
                        <?php endif; ?>
                        <a href="index.php?page=ProductOverview&id=<?php echo $related['id']; ?>" 
                           class="text-decoration-none product-link">
                            <img class="card-img-top p-3" src="<?php echo $relatedImagePath; ?>" 
                                 alt="<?php echo htmlspecialchars($related['name']); ?>" />
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-3">
                            <a href="index.php?page=ProductOverview&id=<?php echo $related['id']; ?>" 
                               class="text-decoration-none text-dark product-title">
                                <?php echo htmlspecialchars($related['name']); ?>
                            </a>
                        </h5>
                        <div class="mb-3">
                            <?php if ($related['discount_rate'] > 0): ?>
                                <span class="text-muted text-decoration-line-through me-2">
                                    Rs.<?php echo number_format($related['UP'], 2); ?>
                                </span>
                                <span class="text-danger fw-bold">
                                    Rs.<?php echo number_format($related['UP'] * (1 - $related['discount_rate']/100), 2); ?>
                                </span>
                            <?php else: ?>
                                <span class="fw-bold">Rs.<?php echo number_format($related['UP'], 2); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($related['QoH'] > 0 && isset($_COOKIE['user_id'])): ?>
                            <button class="btn btn-outline-primary w-100 mt-3">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="alert-container position-fixed top-0 end-0 p-3" style="z-index: 1100"></div>

<style>
.product-image-container {
    background: linear-gradient(to bottom right, #f8f9fa, #ffffff);
    transition: all 0.3s ease;
}
.product-image-container:hover {
    transform: scale(1.02);
}
.pricing-section {
    transition: all 0.3s ease;
}
.pricing-section:hover {
    transform: translateY(-2px);
}
.purchase-actions {
    position: sticky;
    bottom: 20px;
    z-index: 100;
    transition: all 0.3s ease;
}
.product-image-wrapper {
    transition: transform 0.3s ease;
}
.product-image-wrapper:hover {
    transform: scale(1.02);
}
.related-product-card {
    transition: all 0.3s ease;
}
.related-product-card:hover {
    transform: translateY(-5px);
}
.product-link img {
    transition: transform 0.3s ease;
}
.product-link:hover img {
    transform: scale(1.05);
}
.product-title {
    transition: color 0.3s ease;
}
.product-title:hover {
    color: var(--bs-primary) !important;
}

/* Add these new styles */
.quantity-control::-webkit-outer-spin-button,
.quantity-control::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.quantity-control[type=number] {
    appearance: textfield;
    -moz-appearance: textfield;
}
.quantity-input .form-control {
    border-left: 0;
    border-right: 0;
    background-color: white;
}
.quantity-input .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.quantity-input .btn {
    z-index: 0;
}
.alert-container {
    max-width: 300px;
}
.alert {
    margin-bottom: 1rem;
}
</style>

<script>
function changeQuantity(change) {
    const quantityInput = document.getElementById('quantity');
    const currentValue = parseInt(quantityInput.value) || 1;
    const maxStock = <?php echo $product['QoH']; ?>;
    
    let newValue = currentValue + change;
    if (newValue < 1) newValue = 1;
    if (newValue > maxStock) newValue = maxStock;
    
    quantityInput.value = newValue;
}

document.getElementById('quantity').addEventListener('change', function() {
    const maxStock = <?php echo $product['QoH']; ?>;
    if (this.value < 1) this.value = 1;
    if (this.value > maxStock) this.value = maxStock;
});

function showAlert(message, type = 'success') {
    const alertContainer = document.querySelector('.alert-container');
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    alertContainer.appendChild(alertDiv);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

function addToCart() {
    const userId = <?php echo isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : 'null'; ?>;
    const itemId = <?php echo $product_id; ?>;
    const quantity = parseInt(document.getElementById('quantity').value);

    if (!userId) {
        showAlert('Please log in to add items to cart', 'danger');
        return;
    }

    fetch('/ajax/cart_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=add&item_id=${itemId}&quantity=${quantity}&user_id=${userId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Item added to cart successfully!');
            setTimeout(() => {
                location.reload();
            }, 500);
        } else {
            showAlert(data.message || 'Failed to add item to cart', 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while adding to cart', 'danger');
    });
}

function buyNow() {
    const quantity = document.getElementById('quantity').value;
    const itemId = <?= $product_id ?>; 
    const finalPrice = <?= $product['discount_rate'] > 0 ? 
        $product['UP'] * (1 - $product['discount_rate']/100) : 
        $product['UP'] ?>;
    
    window.location.href = '/pages/ordersummary.php?buynow=true&item_id=' + itemId + '&quantity=' + quantity;
}
</script>
