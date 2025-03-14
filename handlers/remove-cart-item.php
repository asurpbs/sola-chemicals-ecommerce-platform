<?php
require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
session_start();

header('Content-Type: application/json');

if (!isset($_COOKIE['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not logged in']);
    exit;
}

if (!isset($_POST['cart_item_id'])) {
    echo json_encode(['success' => false, 'error' => 'Missing cart item ID']);
    exit;
}

$user_id = $_COOKIE['user_id'];
$cart_item_id = intval($_POST['cart_item_id']);

try {
    // Verify cart item belongs to the user's cart
    $verify_stmt = $conn->prepare("
        SELECT ci.id 
        FROM cart_item ci 
        JOIN cart c ON ci.cart_id = c.id 
        WHERE ci.id = :cart_item_id 
        AND c.user_id = :user_id
    ");
    
    $verify_stmt->bindParam(':cart_item_id', $cart_item_id, PDO::PARAM_INT);
    $verify_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $verify_stmt->execute();
    
    if ($verify_stmt->rowCount() > 0) {
        // If item belongs to user's cart, delete it
        $delete_stmt = $conn->prepare("DELETE FROM cart_item WHERE id = :cart_item_id");
        $delete_stmt->bindParam(':cart_item_id', $cart_item_id, PDO::PARAM_INT);
        $success = $delete_stmt->execute();
        
        echo json_encode(['success' => $success]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Item not found in your cart']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
