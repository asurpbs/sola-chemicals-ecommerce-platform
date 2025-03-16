<?php
require_once '../context/connect.php';
session_start();

if (!isset($_COOKIE['user_id'])) {
    header('Location: signin.php');
    exit;
}

$user_id = $_COOKIE['user_id'];

// Get user details
$stmt = $conn->prepare("
    SELECT u.*, ut.telephone1, ut.telephone2, ua.address1, ua.address2, ua.postal_code, c.name_en as city 
    FROM user u 
    LEFT JOIN user_telephone ut ON u.id = ut.user_id
    LEFT JOIN user_address ua ON u.id = ua.user_id
    LEFT JOIN city c ON ua.city_id = c.id
    WHERE u.id = ?
");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle both cart checkout and buy now
if (isset($_GET['buynow']) && isset($_GET['item_id']) && isset($_GET['quantity'])) {
    // Get the item details for buy now case
    $stmt = $conn->prepare("
        SELECT i.*, c.name as category_name,
            ? as quantity, 
            CASE 
                WHEN i.discount_rate > 0 
                THEN i.UP * (1 - i.discount_rate/100) * ?
                ELSE i.UP * ?
            END as subtotal
        FROM item i
        LEFT JOIN category c ON i.category_id = c.id 
        WHERE i.id = ?
    ");
    
    $item_id = $_GET['item_id'];
    $quantity = $_GET['quantity'];
    
    $stmt->execute([$quantity, $quantity, $quantity, $item_id]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $checkout_type = 'buynow';

} else if (isset($_GET['items'])) {
    // Handle cart checkout case
    if (!isset($_GET['items'])) {
        header('Location: /index.php');
        exit;
    }

    $selected_items = array_filter(explode(',', $_GET['items'])); // Filter out empty values

    if (empty($selected_items)) {
        header('Location: /index.php');
        exit;
    }

    $placeholders = str_repeat('?,', count($selected_items) - 1) . '?';
    $stmt = $conn->prepare("
        SELECT i.*, ci.quantity, ci.id as cart_item_id, (i.UP * ci.quantity) as subtotal
        FROM cart_item ci 
        JOIN cart c ON ci.cart_id = c.id
        JOIN item i ON ci.item_id = i.id
        WHERE c.user_id = ? AND ci.id IN ($placeholders)
    ");

    $params = array_merge([$user_id], $selected_items);
    $stmt->execute($params);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cart_items)) {
        header('Location: /index.php');
        exit;
    }
    $checkout_type = 'cart';
} else {
    header('Location: /index.php');
    exit;
}

// Get delivery methods
$stmt = $conn->prepare("SELECT * FROM delivery_method");
$stmt->execute();
$delivery_methods = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate total
$subtotal = array_sum(array_column($cart_items, 'subtotal'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Summary - Sola Chemicals</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background-color: #eef0f2; /* Darker background */ 
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,.12);
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 1.5rem;
        }
        .product-img {
            width: 120px; /* Increased from 80px */
            height: 120px; /* Increased from 80px */
            object-fit: contain; /* Changed from cover to contain */
            border-radius: 8px;
            background: #fff;
            padding: 8px;
            border: 1px solid #eee;
        }
        .item-row {
            padding: 1rem;
            border-bottom: 1px solid #f3f3f3;
        }
        .item-row:last-child {
            border-bottom: none;
        }
        .address-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 0.5rem;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        .total-row {
            border-top: 2px solid #eee;
            margin-top: 1rem;
            padding-top: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .breadcrumb {
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row g-4">
            <!-- Order Details Column -->
            <div class="col-lg-8">
                <!-- Delivery Info -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Delivery Information</h5>
                        <a href="/pages/profile.php" class="btn btn-outline-primary btn-sm">Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Contact Details</h6>
                                <p class="mb-1"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></p>
                                <p class="mb-1"><i class="bi bi-telephone-fill text-muted"></i> <?= htmlspecialchars($user['telephone1']) ?></p>
                                <p class="mb-3"><i class="bi bi-envelope-fill text-muted"></i> <?= htmlspecialchars($user['email']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6>Delivery Address</h6>
                                <div class="address-box">
                                    <p class="mb-1"><?= htmlspecialchars($user['address1']) ?></p>
                                    <p class="mb-1"><?= htmlspecialchars($user['address2']) ?></p>
                                    <p class="mb-1"><?= htmlspecialchars($user['city']) ?></p>
                                    <p class="mb-0">Postal Code: <?= htmlspecialchars($user['postal_code']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Order Items (<?= count($cart_items) ?>)</h5>
                    </div>
                    <div class="card-body p-0">
                        <?php foreach ($cart_items as $item): ?>
                        <div class="item-row d-flex align-items-center">
                            <img src="/uploads/product/<?= htmlspecialchars($item['image'] ?: 'default.jpg') ?>" 
                                 alt="<?= htmlspecialchars($item['name']) ?>" 
                                 class="product-img me-3"
                                 onerror="this.src='/assets/images/default-product.jpg'">
                            <div class="flex-grow-1">
                                <h6 class="mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                <p class="mb-0 text-muted">
                                    Quantity: <?= $item['quantity'] ?> × Rs. <?= number_format($item['UP'], 2) ?>
                                </p>
                            </div>
                            <div class="ms-3 text-end">
                                <h6 class="mb-0">Rs. <?= number_format($item['subtotal'], 2) ?></h6>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Payment Summary Column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Payment Summary</h5>
                    </div>
                    <div class="card-body">
                        <form id="checkoutForm">
                            <div class="mb-4">
                                <label class="form-label">Delivery Method</label>
                                <select class="form-select" name="delivery_method" required>
                                    <?php foreach ($delivery_methods as $method): ?>
                                    <option value="<?= $method['id'] ?>" data-fee="<?= $method['fee'] ?>">
                                        <?= htmlspecialchars($method['name']) ?> 
                                        (<?= $method['days'] ?> days) - Rs. <?= number_format($method['fee'], 2) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="summary-item">
                                <span>Subtotal</span>
                                <span>Rs. <?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="summary-item">
                                <span>Delivery Fee</span>
                                <span id="deliveryFee">Rs. 0.00</span>
                            </div>
                            <div class="summary-item total-row">
                                <span>Total</span>
                                <span id="totalAmount" class="text-primary">Rs. <?= number_format($subtotal, 2) ?></span>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-lock-fill me-2"></i>Pay Now
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                                    Cancel Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div class="modal fade" id="loadingModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="spinner-border text-primary mb-3"></div>
                    <h5>Processing your order...</h5>
                    <p class="text-muted mb-0">Please wait while we confirm your payment.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkoutForm');
            const deliverySelect = form.querySelector('[name="delivery_method"]');
            const deliveryFeeSpan = document.getElementById('deliveryFee');
            const totalSpan = document.getElementById('totalAmount');
            const subtotal = <?= $subtotal ?>;

            function formatCurrency(amount) {
                return `Rs. ${parseFloat(amount).toFixed(2)}`;
            }

            function calculateTotal() {
                const deliveryFee = parseFloat(deliverySelect.options[deliverySelect.selectedIndex].dataset.fee) || 0;
                const total = subtotal + deliveryFee;
                return {
                    deliveryFee: deliveryFee,
                    total: total
                };
            }

            function updateDisplay() {
                const { deliveryFee, total } = calculateTotal();
                deliveryFeeSpan.textContent = formatCurrency(deliveryFee);
                totalSpan.textContent = formatCurrency(total);
            }

            // Initialize total on page load
            updateDisplay();

            // Update when delivery method changes
            deliverySelect.addEventListener('change', updateDisplay);

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Show loading overlay
                document.getElementById('loadingOverlay').style.display = 'flex';
                document.getElementById('submitSpinner').classList.remove('d-none');
                
                const { deliveryFee, total } = calculateTotal();
                const formData = new FormData(this);
                
                // Add calculated values to form data
                formData.append('delivery_fee', deliveryFee.toFixed(2));
                formData.append('total', total.toFixed(2));
                formData.append('subtotal', subtotal.toFixed(2));
                
                <?php if (isset($_GET['buynow'])): ?>
                formData.append('checkout_type', 'buynow');
                formData.append('item_id', '<?= $_GET['item_id'] ?>');
                formData.append('quantity', '<?= $_GET['quantity'] ?>');
                <?php else: ?>
                formData.append('checkout_type', 'cart');
                formData.append('selectedItems', '<?= $_GET['items'] ?>');
                <?php endif; ?>

                try {
                    const response = await fetch('/handlers/process-order.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        // Show success message with animation
                        const toast = document.createElement('div');
                        toast.className = 'position-fixed top-0 end-0 p-3';
                        toast.style.zIndex = '9999';
                        toast.innerHTML = `
                            <div class="toast show bg-success text-white" role="alert">
                                <div class="toast-body">
                                    Order placed successfully!
                                </div>
                            </div>
                        `;
                        document.body.appendChild(toast);
                        
                        setTimeout(() => {
                            window.location.href = '/index.php';
                        }, 2000);
                    } else {
                        throw new Error(result.message || 'Failed to place order');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message || 'Failed to process order');
                } finally {
                    document.getElementById('loadingOverlay').style.display = 'none';
                    document.getElementById('submitSpinner').classList.add('d-none');
                }
            });
        });
    </script>
</body>
</html>
