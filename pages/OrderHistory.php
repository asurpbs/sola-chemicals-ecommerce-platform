<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order History</title>
    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <style>
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
        }

        .order-status {
            font-size: 0.9rem;
        }

        .order-actions button {
            margin-left: 10px;
        }
    </style>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
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
    $stmt->execute([$user_id]); // Changed to PDO style parameter binding
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Changed to PDO fetch method

    ?>

    <div class="container my-5">
        <h2 class="mb-4">Order History</h2>
        <a href="/index.php" class="btn btn-outline-secondary mb-4">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>

        <?php if (count($result) > 0): ?> <!-- Changed num_rows check to count() -->
            <?php foreach($result as $order): ?> <!-- Changed while to foreach -->
                <div class="order-card">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><?php echo htmlspecialchars($order['item_name']); ?></h5>
                            <p class="mb-1">Order ID: #<?php echo $order['id']; ?></p>
                            <p class="mb-1">Quantity: <?php echo $order['quantity']; ?></p>
                            <p class="mb-1">Unit Price: Rs. <?php echo number_format($order['unit_price'], 2); ?></p>
                            <p class="mb-1">Delivery Method: <?php echo htmlspecialchars($order['delivery_method']); ?></p>
                            <p class="mb-1">Delivery Fee: Rs. <?php echo number_format($order['delivery_fee'], 2); ?></p>
                            <p class="mb-1">Total: Rs. <?php 
                                echo number_format(($order['unit_price'] * $order['quantity']) + $order['delivery_fee'], 2); 
                            ?></p>
                        </div>
                        <div class="col-md-4">
                            <div class="order-status text-end">
                                <p class="mb-1">
                                    Order Status: 
                                    <span class="badge <?php echo $order['status'] ? 'bg-success' : 'bg-warning'; ?>">
                                        <?php echo $order['status'] ? 'Delivered' : 'Pending'; ?>
                                    </span>
                                </p>
                                <p class="mb-1">
                                    Payment Status:
                                    <span class="badge <?php 
                                        echo $order['payment_status'] === 'Successful' ? 'bg-success' : 'bg-danger'; 
                                    ?>">
                                        <?php echo htmlspecialchars($order['payment_status']); ?>
                                    </span>
                                </p>
                                <p class="mb-1">Ordered: <?php 
                                    echo date('M d, Y', strtotime($order['date_created'])); 
                                ?></p>
                                <?php if ($order['delivered_date']): ?>
                                    <p class="mb-1">Delivered: <?php 
                                        echo date('M d, Y', strtotime($order['delivered_date'])); 
                                    ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">
                You haven't placed any orders yet. Start shopping to see your order history!
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
