<?php
require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch($action) {
        case 'remove':
            if (isset($_POST['cart_item_id']) && isset($_COOKIE['user_id'])) {
                $user_id = $_COOKIE['user_id'];
                $cart_item_id = intval($_POST['cart_item_id']);
                try {
                    // First verify this cart item belongs to the user
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
                        // If verification passes, delete the item
                        $delete_stmt = $conn->prepare("DELETE FROM cart_item WHERE id = :cart_item_id");
                        $delete_stmt->bindParam(':cart_item_id', $cart_item_id, PDO::PARAM_INT);
                        $success = $delete_stmt->execute();
                        
                        echo json_encode(['success' => $success]);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
                    }
                } catch (PDOException $e) {
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Missing required parameters']);
            }
            break;
        
        case 'count':
            if (isset($_COOKIE['user_id'])) {
                $user_id = $_COOKIE['user_id'];
                try {
                    $stmt = $conn->prepare("SELECT COUNT(ci.id) as count 
                                          FROM cart_item ci 
                                          INNER JOIN cart c ON ci.cart_id = c.id 
                                          WHERE c.user_id = :user_id");
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'] ?? 0;
                    
                    echo json_encode(['success' => true, 'count' => (int)$count]);
                } catch (PDOException $e) {
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => true, 'count' => 0]);
            }
            break;
            
        default:
            echo json_encode(['success' => false, 'error' => 'Invalid action']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
