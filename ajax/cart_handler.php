<?php
require_once('../includes/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$response = ['success' => false, 'message' => ''];

try {
    $userId = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
    $itemId = isset($_POST['item_id']) ? (int)$_POST['item_id'] : null;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : null;

    if (!$userId || !$itemId || !$quantity) {
        throw new Exception('Missing required parameters');
    }

    // Start transaction
    $conn->beginTransaction();

    // Get or create cart for user
    $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ?");
    $stmt->execute([$userId]);
    $cart = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$cart) {
        $stmt = $conn->prepare("INSERT INTO cart (user_id) VALUES (?)");
        $stmt->execute([$userId]);
        $cartId = $conn->lastInsertId();
    } else {
        $cartId = $cart['id'];
    }

    // Add item to cart
    $stmt = $conn->prepare("INSERT INTO cart_item (cart_id, item_id, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$cartId, $itemId, $quantity]);

    $conn->commit();
    $response['success'] = true;
    $response['message'] = 'Item added to cart successfully';

} catch (Exception $e) {
    $conn->rollBack();
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
