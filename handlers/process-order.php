<?php
require_once '../context/connect.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

if (!isset($_COOKIE['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

try {
    $user_id = $_COOKIE['user_id'];
    $delivery_method_id = $_POST['delivery_method'];
    $delivery_fee = floatval($_POST['delivery_fee']);
    $total = floatval($_POST['total']); // This now includes delivery fee
    $subtotal = floatval($_POST['subtotal']);
    $checkout_type = $_POST['checkout_type'];

    $conn->beginTransaction();

    if ($checkout_type === 'buynow') {
        $buyNowItem = json_decode($_POST['buyNowItem'], true);
        
        // Get item details
        $stmt = $conn->prepare("
            SELECT i.*, ? as quantity, (i.UP * ?) as total
            FROM item i 
            WHERE i.id = ?
        ");
        $stmt->execute([$buyNowItem['quantity'], $buyNowItem['quantity'], $buyNowItem['id']]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Get cart items
        $selected_items = json_decode($_POST['selectedItems'], true);

        if (empty($selected_items)) {
            throw new Exception('No items selected for purchase');
        }

        $placeholders = str_repeat('?,', count($selected_items) - 1) . '?';
        $stmt = $conn->prepare("
            SELECT ci.*, i.UP, (i.UP * ci.quantity) as total
            FROM cart_item ci 
            JOIN cart c ON ci.cart_id = c.id 
            JOIN item i ON ci.item_id = i.id 
            WHERE c.user_id = ? AND ci.id IN ($placeholders)
        ");
        
        $params = [$user_id];
        foreach ($selected_items as $item) {
            $params[] = $item['id'];
        }
        
        $stmt->execute($params);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Process orders (works for both cart and buy now)
    foreach ($items as $item) {
        // Insert order
        $stmt = $conn->prepare("
            INSERT INTO `order` (item_id, user_id, quantity, delivery_method_id, total) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $item['item_id'],
            $user_id,
            $item['quantity'],
            $delivery_method_id,
            $total // This includes delivery fee
        ]);
        
        $order_id = $conn->lastInsertId();

        // Create payment record
        $stmt = $conn->prepare("
            INSERT INTO payment (order_id, payment_method, transaction, status)
            VALUES (?, 'Online Payment', ?, 'Completed')
        ");
        $stmt->execute([$order_id, uniqid()]);

        // Update item stock
        $stmt = $conn->prepare("
            UPDATE item 
            SET QoH = QoH - ? 
            WHERE id = ?
        ");
        $stmt->execute([$item['quantity'], $item['item_id']]);

        // Only remove from cart if it's a cart checkout
        if ($checkout_type === 'cart') {
            $stmt = $conn->prepare("DELETE FROM cart_item WHERE id = ?");
            $stmt->execute([$item['id']]);
        }
    }

    $conn->commit();
    echo json_encode(['success' => true]);

} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
