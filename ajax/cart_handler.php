<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/context/connect.php';
header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $item_id = $_POST['item_id'] ?? '';
        $quantity = $_POST['quantity'] ?? 1;
        $user_id = $_POST['user_id'] ?? '';

        if ($action === 'add' && $item_id && $user_id) {
            // First check/create cart for user
            $check_cart_sql = "SELECT id FROM cart WHERE user_id = ?";
            $check_cart_stmt = $conn->prepare($check_cart_sql);
            $check_cart_stmt->execute([$user_id]);
            
            $cart_id = null;
            if ($check_cart_stmt->rowCount() > 0) {
                $cart_id = $check_cart_stmt->fetch(PDO::FETCH_ASSOC)['id'];
            } else {
                // Create new cart
                $create_cart_sql = "INSERT INTO cart (user_id) VALUES (?)";
                $create_cart_stmt = $conn->prepare($create_cart_sql);
                $create_cart_stmt->execute([$user_id]);
                $cart_id = $conn->lastInsertId();
            }

            // Now check if item exists in cart
            $check_item_sql = "SELECT id FROM cart_item WHERE cart_id = ? AND item_id = ?";
            $check_item_stmt = $conn->prepare($check_item_sql);
            $check_item_stmt->execute([$cart_id, $item_id]);
            
            if ($check_item_stmt->rowCount() > 0) {
                // Update existing cart item
                $sql = "UPDATE cart_item SET quantity = quantity + ? WHERE cart_id = ? AND item_id = ?";
                $params = [$quantity, $cart_id, $item_id];
            } else {
                // Insert new cart item
                $sql = "INSERT INTO cart_item (cart_id, item_id, quantity) VALUES (?, ?, ?)";
                $params = [$cart_id, $item_id, $quantity];
            }
            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute($params);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Item added to cart successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to add item to cart']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
