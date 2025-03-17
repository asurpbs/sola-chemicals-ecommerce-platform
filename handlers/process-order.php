<?php
require_once '../context/connect.php';
session_start();

header('Content-Type: application/json');

if (!isset($_COOKIE['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

try {
    $user_id = $_COOKIE['user_id'];
    $delivery_method_id = $_POST['delivery_method'];
    $total = floatval($_POST['total']); 
    $checkout_type = $_POST['checkout_type'];

    $conn->beginTransaction();

    if ($checkout_type === 'buynow') {
        $item_id = $_POST['item_id'];
        $quantity = intval($_POST['quantity']);

        // Create order record
        $stmt = $conn->prepare("INSERT INTO `order` (item_id, user_id, quantity, delivery_method_id, total) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$item_id, $user_id, $quantity, $delivery_method_id, $total]);

        // Update item quantity
        $stmt = $conn->prepare("UPDATE item SET QoH = QoH - ? WHERE id = ? AND QoH >= ?");
        $result = $stmt->execute([$quantity, $item_id, $quantity]);
        
        if ($stmt->rowCount() === 0) {
            throw new Exception('Not enough stock available');
        }
    } else {
        // Handle cart checkout
        $selected_items = explode(',', $_POST['selectedItems']);
        
        // Get cart items
        $placeholders = str_repeat('?,', count($selected_items) - 1) . '?';
        $stmt = $conn->prepare("
            SELECT ci.*, i.QoH, i.id as item_id 
            FROM cart_item ci 
            JOIN cart c ON ci.cart_id = c.id 
            JOIN item i ON ci.item_id = i.id
            WHERE c.user_id = ? AND ci.id IN ($placeholders)
        ");
        
        $params = array_merge([$user_id], $selected_items);
        $stmt->execute($params);
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cart_items as $item) {
            // Create order record for each item
            $stmt = $conn->prepare("INSERT INTO `order` (item_id, user_id, quantity, delivery_method_id, total) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$item['item_id'], $user_id, $item['quantity'], $delivery_method_id, $total]);

            // Update item quantity
            $stmt = $conn->prepare("UPDATE item SET QoH = QoH - ? WHERE id = ? AND QoH >= ?");
            $result = $stmt->execute([$item['quantity'], $item['item_id'], $item['quantity']]);
            
            if ($stmt->rowCount() === 0) {
                throw new Exception('Not enough stock available');
            }

            // Remove from cart
            $stmt = $conn->prepare("DELETE FROM cart_item WHERE id = ?");
            $stmt->execute([$item['id']]);
        }
    }

    $conn->commit();
    echo json_encode([
        'success' => true,
        'message' => 'Order placed successfully'
    ]);

} catch (Exception $e) {
    $conn->rollBack();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
