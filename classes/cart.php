<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Cart {
    private $user_id;
    private $item_id;
    private $quantity;

    public function __construct($user_id, $item_id, $quantity) {
        global $conn;
        $this->user_id = $user_id;
        $this->item_id = $item_id;
        $this->quantity = $quantity;
        // Insert cart data
        $stmt = $conn->prepare("INSERT INTO cart (user_id, item_id, quantity) VALUES (?, ?, ?)");
        $stmt->bindValue(1, $this->user_id);
        $stmt->bindValue(2, $this->item_id);
        $stmt->bindValue(3, $this->quantity);
        $stmt->execute();
        $stmt = null;
    }

    public function updateQuantity($quantity) {
        global $conn;
        $this->quantity = $quantity;
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND item_id = ?");
        $stmt->bindValue(1, $this->quantity);
        $stmt->bindValue(2, $this->user_id);
        $stmt->bindValue(3, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Retrieve the cart items and quantity as a 2D array when user id is inputted as argument
     */
    public static function getItems($user_id) {
        global $conn;
        $items = [];
        $stmt = $conn->prepare("SELECT item_id, quantity FROM cart WHERE user_id = ?");
        $stmt->bindValue(1, $user_id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = [$row['item_id'], $row['quantity']];
        }
        $stmt = null;
        return $items;
    }

    public function deleteItem($user_id, $item_id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND item_id = ?");
        $stmt->bindValue(1, $user_id);
        $stmt->bindValue(2, $item_id);
        $stmt->execute();
        $stmt = null;
    }
}
?>
