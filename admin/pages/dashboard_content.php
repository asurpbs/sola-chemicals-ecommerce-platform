<?php
// Include the new database connection
include('../context/connect.php'); // This includes the new connect.php with proper database credentials

try {
    // Fetch total users
    $total_users_query = "SELECT COUNT(*) AS total_users FROM user";
    $total_users_stmt = $conn->query($total_users_query);
    $total_users = $total_users_stmt->fetch(PDO::FETCH_ASSOC)['total_users'];
    $total_users_stmt->closeCursor(); // Close the cursor after fetching the result

    // Fetch total orders
    $total_orders_query = "SELECT COUNT(*) AS total_orders FROM `order`";
    $total_orders_stmt = $conn->query($total_orders_query);
    $total_orders = $total_orders_stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];
    $total_orders_stmt->closeCursor(); // Close the cursor after fetching the result

    // Fetch total revenue
    $total_revenue_query = "
        SELECT SUM(p.transaction) AS total_revenue
        FROM `order` o
        JOIN payment p ON o.id = p.order_id
        WHERE p.status = 'completed';  -- Assuming only completed payments should count towards revenue
    ";
    $total_revenue_stmt = $conn->query($total_revenue_query);
    $total_revenue = $total_revenue_stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];
    $total_revenue_stmt->closeCursor(); // Close the cursor after fetching the result

    // Fetch the latest news articles
    $news_query = "SELECT * FROM `news_and_events` WHERE `status` = 1 ORDER BY `date_created` DESC LIMIT 5";
    $news_stmt = $conn->query($news_query);
    $news_articles = $news_stmt->fetchAll(PDO::FETCH_ASSOC);
    $news_stmt->closeCursor(); // Close the cursor after fetching the results

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection (optional, PDO automatically closes on script end)
$conn = null;
?>

<div class="container">
    <div class="row">
        <!-- Total Users, Orders, and Revenue -->
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php echo number_format($total_users); ?> Users</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?php echo number_format($total_orders); ?> Orders</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$<?php echo number_format($total_revenue, 2); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Donut Chart (Analytics) -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Analytics</h5>
                    <canvas id="donutChart"></canvas>
                </div>
            </div>
        </div>

        <!-- News and Updates -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">News and Updates</h5>
                    <ul class="list-unstyled">
                        <?php foreach ($news_articles as $article): ?>
                            <li>
                                <?php if (!empty($article['article_image_url'])): ?>
                                    <img src="<?php echo $article['article_image_url']; ?>" alt="News Image" class="img-fluid" style="max-height: 50px; margin-right: 10px;">
                                <?php endif; ?>
                                <strong><?php echo htmlspecialchars($article['article_title']); ?></strong><br>
                                <small><?php echo date("F j, Y, g:i a", strtotime($article['date_published'])); ?></small><br>
                                <p><?php echo htmlspecialchars(substr($article['content'], 0, 100)) . '...'; ?></p>
                                <a href="news_detail.php?id=<?php echo $article['id']; ?>" class="btn btn-link">Read more</a>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Activities -->
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Recent Activities</h5>
                    <ul class="list-unstyled">
                        <!-- Example recent activities -->
                        <li><i class="bi bi-clock me-2"></i>New order placed by John Doe</li>
                        <li><i class="bi bi-clock me-2"></i>Product updated: iPhone 13</li>
                        <li><i class="bi bi-clock me-2"></i>Settings updated by Admin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js for the Donut Chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('donutChart').getContext('2d');
    var donutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Orders', 'Revenue', 'Users'],
            datasets: [{
                label: 'Analytics',
                data: [<?php echo $total_orders; ?>, <?php echo $total_revenue; ?>, <?php echo $total_users; ?>],
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>
