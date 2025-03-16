<?php
require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$cartItemId = $input['cartItemId'] ?? null;
$action = $input['action'] ?? null;

if (!$cartItemId || !$action) {
    echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
    exit;
}

try {
    // First get current quantity and validate cart item belongs to user
    $sql = "SELECT ci.quantity, ci.item_id, i.QoH, i.name 
            FROM cart_item ci 
            JOIN cart c ON ci.cart_id = c.id 
            JOIN item i ON ci.item_id = i.id
            WHERE ci.id = ? AND c.user_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$cartItemId, $_COOKIE['user_id']]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$item) {
        echo json_encode(['success' => false, 'message' => 'Cart item not found']);
        exit;
    }

    $newQuantity = $item['quantity'];
    if ($action === 'increase') {
        if ($newQuantity >= $item['QoH']) {
            echo json_encode(['success' => false, 'message' => 'Cannot exceed available stock']);
            exit;
        }
        $newQuantity++;
    } else if ($action === 'decrease') {
        if ($newQuantity <= 1) {
            echo json_encode(['success' => false, 'message' => 'Quantity cannot be less than 1']);
            exit;
        }
        $newQuantity--;
    }

    // Update quantity
    $updateSql = "UPDATE cart_item SET quantity = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->execute([$newQuantity, $cartItemId]);

    // Get updated cart count
    $countSql = "SELECT COUNT(*) as count FROM cart_item ci 
                 JOIN cart c ON ci.cart_id = c.id 
                 WHERE c.user_id = ?";
    $countStmt = $conn->prepare($countSql);
    $countStmt->execute([$_COOKIE['user_id']]);
    $cartCount = $countStmt->fetch(PDO::FETCH_ASSOC)['count'];

    echo json_encode([
        'success' => true,
        'message' => 'Quantity updated successfully',
        'newQuantity' => $newQuantity,
        'cartCount' => $cartCount
    ]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
