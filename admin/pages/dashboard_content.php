<?php
include('../context/connect.php');

try {
    // Main Metrics
    $main_query = "
        SELECT 
            (SELECT COUNT(*) FROM user) AS total_users,
            (SELECT COUNT(*) FROM `order`) AS total_orders,
            (SELECT COALESCE(SUM(total), 0) FROM `order` WHERE status = 0x31) AS total_revenue,
            (SELECT COUNT(*) FROM item WHERE QoH < 10) AS low_stock_items
    ";
    $main_stmt = $conn->query($main_query);
    $main_data = $main_stmt->fetch(PDO::FETCH_ASSOC);

    // Sales by Category
    $category_query = "
        SELECT c.name AS category, SUM(o.quantity) AS total_sold
        FROM `order` o
        JOIN item i ON o.item_id = i.id
        JOIN category c ON i.category_id = c.id
        GROUP BY c.id
        ORDER BY total_sold DESC
    ";
    $category_stmt = $conn->query($category_query);
    $category_data = $category_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Payment Methods
    $payment_query = "
        SELECT payment_method, COUNT(*) AS count 
        FROM payment 
        GROUP BY payment_method
    ";
    $payment_stmt = $conn->query($payment_query);
    $payment_data = $payment_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Recent Orders
    $orders_query = "
        SELECT o.id, i.name AS item, o.quantity, o.date_created 
        FROM `order` o
        JOIN item i ON o.item_id = i.id
        ORDER BY o.date_created DESC 
        LIMIT 5
    ";
    $orders_stmt = $conn->query($orders_query);
    $orders_data = $orders_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Low Stock Items
    $stock_query = "
        SELECT name, QoH 
        FROM item 
        WHERE QoH < 10
        ORDER BY QoH ASC 
        LIMIT 5
    ";
    $stock_stmt = $conn->query($stock_query);
    $stock_data = $stock_stmt->fetchAll(PDO::FETCH_ASSOC);

    // User Growth (6 months)
    $user_growth_query = "
        SELECT 
            DATE_FORMAT(registered_date, '%Y-%m') AS month,
            COUNT(*) AS count
        FROM user
        WHERE registered_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
        GROUP BY DATE_FORMAT(registered_date, '%Y-%m')
        ORDER BY month ASC
    ";
    $user_growth_stmt = $conn->query($user_growth_query);
    $user_growth_data = $user_growth_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Revenue Growth (6 months)
    $revenue_query = "
        SELECT 
            DATE_FORMAT(date_created, '%Y-%m') AS month,
            COALESCE(SUM(total), 0) AS amount
        FROM `order`
        WHERE status = 0x31
        AND date_created >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
        GROUP BY DATE_FORMAT(date_created, '%Y-%m')
        ORDER BY month ASC
    ";
    $revenue_stmt = $conn->query($revenue_query);
    $revenue_data = $revenue_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Order Status
    $status_query = "
        SELECT 
            SUM(status = 0x31) AS completed,
            SUM(status = 0x30) AS pending
        FROM `order`
    ";
    $status_stmt = $conn->query($status_query);
    $status_data = $status_stmt->fetch(PDO::FETCH_ASSOC);

    // Top Products
    $products_query = "
        SELECT i.name, SUM(o.quantity) AS total
        FROM `order` o
        JOIN item i ON o.item_id = i.id
        GROUP BY i.name
        ORDER BY total DESC
        LIMIT 5
    ";
    $products_stmt = $conn->query($products_query);
    $products_data = $products_stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close connections
    $main_stmt->closeCursor();
    $category_stmt->closeCursor();
    $payment_stmt->closeCursor();
    $orders_stmt->closeCursor();
    $stock_stmt->closeCursor();
    $user_growth_stmt->closeCursor();
    $revenue_stmt->closeCursor();
    $status_stmt->closeCursor();
    $products_stmt->closeCursor();

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<div class="container-fluid">
    <!-- Key Metrics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text display-4"><?= number_format($main_data['total_users']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text display-4"><?= number_format($main_data['total_orders']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text display-4">Rs <?= number_format($main_data['total_revenue'], 2) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Items</h5>
                    <p class="card-text display-4"><?= number_format($main_data['low_stock_items']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5>User Growth (6 Months)</h5>
                </div>
                <div class="card-body">
                    <canvas id="userGrowthChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Revenue Growth (6 Months)</h5>
                </div>
                <div class="card-body">
                    <canvas id="revenueGrowthChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Order Status</h5>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Payment Methods</h5>
                </div>
                <div class="card-body">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Sales by Category</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders_data as $order): ?>
                                <tr>
                                    <td>#<?= $order['id'] ?></td>
                                    <td><?= htmlspecialchars($order['item']) ?></td>
                                    <td><?= $order['quantity'] ?></td>
                                    <td><?= date('M j, Y', strtotime($order['date_created'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Low Stock Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stock_data as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= $item['QoH'] ?></td>
                                    <td>
                                        <span class="badge <?= $item['QoH'] < 5 ? 'bg-danger' : 'bg-warning' ?>">
                                            <?= $item['QoH'] < 5 ? 'Critical' : 'Low' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Top Selling Products</h5>
                </div>
                <div class="card-body">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Growth Chart
    new Chart(document.getElementById('userGrowthChart'), {
        type: 'line',
        data: {
            labels: <?= json_encode(array_column($user_growth_data, 'month')) ?>,
            datasets: [{
                label: 'New Users',
                data: <?= json_encode(array_column($user_growth_data, 'count')) ?>,
                borderColor: '#4e73df',
                tension: 0.3,
                fill: true,
                backgroundColor: 'rgba(78, 115, 223, 0.05)'
            }]
        }
    });

    // Revenue Growth Chart
    new Chart(document.getElementById('revenueGrowthChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($revenue_data, 'month')) ?>,
            datasets: [{
                label: 'Revenue (LKR)',
                data: <?= json_encode(array_column($revenue_data, 'amount')) ?>,
                backgroundColor: '#1cc88a'
            }]
        }
    });

    // Order Status Chart
    new Chart(document.getElementById('orderStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending'],
            datasets: [{
                data: [<?= $status_data['completed'] ?>, <?= $status_data['pending'] ?>],
                backgroundColor: ['#36b9cc', '#f6c23e']
            }]
        }
    });

    // Payment Methods Chart
    new Chart(document.getElementById('paymentChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode(array_column($payment_data, 'payment_method')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($payment_data, 'count')) ?>,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
            }]
        }
    });

    // Sales by Category Chart
    new Chart(document.getElementById('categoryChart'), {
        type: 'polarArea',
        data: {
            labels: <?= json_encode(array_column($category_data, 'category')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($category_data, 'total_sold')) ?>,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
            }]
        }
    });

    // Top Products Chart
    new Chart(document.getElementById('topProductsChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($products_data, 'name')) ?>,
            datasets: [{
                label: 'Units Sold',
                data: <?= json_encode(array_column($products_data, 'total')) ?>,
                backgroundColor: '#858796'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>