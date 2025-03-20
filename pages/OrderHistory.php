<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order History</title>
    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <style>
        /* ... your CSS ... */
    </style>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <?php
    require_once '../context/connect.php';
    
    // Verify user is logged in
    if (!isset($_COOKIE['user_id'])) {
        header('Location: signin.php');
        exit();
    }

    // Fetch order history for current user
    $user_id = $_COOKIE['user_id'];
    $sql = "SELECT o.*, i.name as item_name, i.UP as unit_price, 
            d.name as delivery_method, d.fee as delivery_fee,
            p.payment_method, p.status as payment_status
            FROM `order` o
            JOIN item i ON o.item_id = i.id
            LEFT JOIN delivery_method d ON o.delivery_method_id = d.id
            LEFT JOIN payment p ON p.order_id = o.id
            WHERE o.user_id = ?
            ORDER BY o.date_created DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]); 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

    ?>

    <div class="container my-5">
        <h2 class="page-title">Order History</h2>
        <a href="/index.php" class="btn back-button btn-outline-secondary mb-4">
            <i class="bi bi-arrow-left me-2"></i>Back to Home
        </a>

        <?php if (count($result) > 0): ?>
            <?php foreach($result as $order): ?>
                <div class="order-card">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="order-title mb-3"><?php echo htmlspecialchars($order['item_name'] ?? 'N/A'); ?></h5>
                            <div class="order-info">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <p class="mb-2"><strong>Order ID:</strong> #<?php echo $order['id']; ?></p>
                                        <p class="mb-2"><strong>Quantity:</strong> <?php echo $order['quantity']; ?></p>
                                        <p class="mb-2"><strong>Unit Price:</strong> Rs. <?php echo number_format($order['unit_price'], 2); ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-2"><strong>Delivery Method:</strong> <?php echo htmlspecialchars($order['delivery_method'] ?? 'Not specified'); ?></p>
                                        <p class="mb-2"><strong>Delivery Fee:</strong> Rs. <?php echo number_format($order['delivery_fee'] ?? 0, 2); ?></p>
                                        <p class="mb-2"><strong>Total:</strong> Rs. <?php 
                                            echo number_format(($order['unit_price'] * $order['quantity']) + ($order['delivery_fee'] ?? 0), 2); 
                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="order-status">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Order Status:</span>
                                        <span class="badge <?php echo $order['status'] ? 'bg-success' : 'bg-warning'; ?>">
                                            <?php echo $order['status'] ? 'Delivered' : 'Pending'; ?>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Payment Status:</span>
                                        <span class="badge <?php 
                                            echo ($order['payment_status'] === 'Successful' ? 'bg-success' : ($order['payment_status'] === 'Payment is declined' ? 'bg-danger' : 'bg-warning')); 
                                        ?>">
                                            <?php echo htmlspecialchars($order['payment_status'] ?? 'Not specified'); ?>
                                        </span>
                                    </div>
                                    <hr class="my-2">
                                    <p class="mb-1"><small>Ordered: <?php 
                                        echo date('M d, Y', strtotime($order['date_created'])); 
                                    ?></small></p>
                                    <?php if ($order['delivered_date']): ?>
                                        <p class="mb-1"><small>Delivered: <?php 
                                            echo date('M d, Y', strtotime($order['delivered_date'])); 
                                        ?></small></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="bi bi-bag-x mb-3 d-block"></i>
                <h4>No Orders Yet</h4>
                <p class="text-muted">You haven't placed any orders yet. Start shopping to see your order history!</p>
                <a href="/index.php" class="btn btn-primary">Start Shopping</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
