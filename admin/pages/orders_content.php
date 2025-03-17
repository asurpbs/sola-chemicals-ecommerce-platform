<?php
session_start();
include('../context/connect.php');

// Fetch Completed Orders with Item Details
$completedOrders = $conn->query("
    SELECT o.id AS order_id, 
           o.total, 
           o.status, 
           o.date_created, 
           CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
           i.name AS item_name,
           o.item_id, 
           o.quantity,
           i.image AS item_image,
           i.UP AS item_price
    FROM `order` o 
    JOIN `user` u ON o.user_id = u.id 
    JOIN `item` i ON o.item_id = i.id
    WHERE o.status = 1  -- Completed orders
    ORDER BY o.date_created DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Fetch Pending Orders with Item Details
$pendingOrders = $conn->query("
    SELECT o.id AS order_id, 
           o.total, 
           o.status, 
           o.date_created, 
           CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
           i.name AS item_name,
           o.item_id, 
           o.quantity,
           i.image AS item_image,
           i.UP AS item_price
    FROM `order` o 
    JOIN `user` u ON o.user_id = u.id 
    JOIN `item` i ON o.item_id = i.id
    WHERE o.status = 0  -- Pending orders
    ORDER BY o.date_created DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Handle Update Order Status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE `order` SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);

    header("Location: orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Orders</h2>

    <!-- Table for Completed Orders -->
    <h3>Completed Orders</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total (Rs)</th>
                <th>Status</th>
                <th>Order Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($completedOrders as $order): ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= number_format($order['total'], 2) ?></td>
                <td><span class="badge bg-success">Completed</span></td>
                <td>
                    <ul>
                        <li><strong>Item:</strong> <?= htmlspecialchars($order['item_name']) ?></li>
                        <li><strong>Quantity:</strong> <?= $order['quantity'] ?></li>
                        <li><strong>Price (Rs):</strong> <?= number_format($order['item_price'], 2) ?></li>
                        <li><img src="<?= $order['item_image'] ?>" alt="<?= $order['item_name'] ?>" width="100"></li>
                    </ul>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#updateOrderModal" 
                            data-id="<?= $order['order_id'] ?>" 
                            data-status="<?= $order['status'] ?>"
                            data-customer="<?= htmlspecialchars($order['customer_name']) ?>" 
                            data-total="<?= number_format($order['total'], 2) ?>" 
                            data-date="<?= $order['date_created'] ?>">
                        Update Status
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Table for Pending Orders -->
    <h3>Pending Orders</h3>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total (Rs)</th>
                <th>Status</th>
                <th>Order Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendingOrders as $order): ?>
            <tr>
                <td><?= $order['order_id'] ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= number_format($order['total'], 2) ?></td>
                <td><span class="badge bg-warning">Pending</span></td>
                <td>
                    <ul>
                        <li><strong>Item:</strong> <?= htmlspecialchars($order['item_name']) ?></li>
                        <li><strong>Quantity:</strong> <?= $order['quantity'] ?></li>
                        <li><strong>Price (Rs):</strong> <?= number_format($order['item_price'], 2) ?></li>
                        <li><img src="<?= $order['item_image'] ?>" alt="<?= $order['item_name'] ?>" width="100"></li>
                    </ul>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#updateOrderModal" 
                            data-id="<?= $order['order_id'] ?>" 
                            data-status="<?= $order['status'] ?>"
                            data-customer="<?= htmlspecialchars($order['customer_name']) ?>" 
                            data-total="<?= number_format($order['total'], 2) ?>" 
                            data-date="<?= $order['date_created'] ?>">
                        Update Status
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<!-- Update Order Modal -->
<div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateOrderModalLabel">Update Order Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="orders.php" method="POST">
        <div class="modal-body">
            <input type="hidden" id="order_id" name="order_id">
            
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" disabled>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total (Rs)</label>
                <input type="text" class="form-control" id="total" name="total" disabled>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Order Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="0">Pending</option>
                    <option value="1">Completed</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="update_order">Update Status</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Populate the modal with order details
const updateOrderModal = document.getElementById('updateOrderModal');
updateOrderModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const orderId = button.getAttribute('data-id');
    const customerName = button.getAttribute('data-customer');
    const total = button.getAttribute('data-total');
    const status = button.getAttribute('data-status');

    document.getElementById('order_id').value = orderId;
    document.getElementById('customer_name').value = customerName;
    document.getElementById('total').value = total;
    document.getElementById('status').value = status;
});
</script>

</body>
</html>
