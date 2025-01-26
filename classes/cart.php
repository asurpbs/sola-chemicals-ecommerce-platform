<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
include $_SERVER['DOCUMENT_ROOT']."/classes/cartItem.php";

class Cart {
    private $user_id;
    private $cart_id;

    /**
     * Constructor to create a new cart or retrieve an existing cart.
     * 
     * @param int|null $cart_id Cart ID
     * @param int|null $user_id User ID
     */
    public function __construct($cart_id = null, $user_id = null) {
        global $conn;
        if ($cart_id) {
            $this->cart_id = $cart_id;
            $stmt = $conn->prepare("SELECT user_id FROM cart WHERE cart_id = ?");
            $stmt->bindValue(1, $this->cart_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->user_id);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        } else {
            $this->user_id = $user_id;
            // Create a cart for the user
            $stmt = $conn->prepare("INSERT INTO cart (user_id) VALUES (?)");
            $stmt->bindValue(1, $this->user_id);
            $stmt->execute();
            $this->cart_id = $conn->lastInsertId();
            $stmt = null;
        }
    }

    /**
     * Get the number of items in the cart.
     * 
     * @return int Number of items
     */
    public function getNoOfItems() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM cart_item WHERE cart_id = ?");
        $stmt->bindValue(1, $this->cart_id);
        $stmt->execute();
        $stmt->bindColumn(1, $count);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $count;
    }

    /**
     * Add an item to the cart.
     * 
     * @param int $item_id Item ID
     * @param int $quantity Quantity
     */
    public function addItem($item_id, $quantity) {
        new CartItem($this->cart_id, $item_id, $quantity);
    }

    /**
     * Delete an item from the cart.
     * 
     * @param int $cartItem_id Cart item ID
     */
    public function deleteItem($cartItem_id) {
        $cartItem = new CartItem($cartItem_id);
        $cartItem->delete();
    }

    /**
     * Update the quantity of an item in the cart.
     * 
     * @param int $cartItem_id Cart item ID
     * @param int $quantity Quantity
     */
    public function updateItem($cartItem_id, $quantity) {
        $updateItem = new CartItem($cartItem_id);
        $updateItem->updateQuantity($quantity);
    }

    /**
     * Get all items in the cart.
     * 
     * @return array Items
     */
    public function getItems() {
        global $conn;
        $stmt = $conn->prepare("SELECT id FROM cart_item WHERE cart_id = ?");
        $stmt->bindValue(1, $this->cart_id);
        $stmt->execute();
        $stmt->bindColumn(1, $cartItem_id);
        $items = array();
        while ($stmt->fetch(PDO::FETCH_BOUND)) {
            $items[] = new CartItem($cartItem_id);
        }
        $stmt = null;
        return $items;
    }

    /**
     * Get the cart ID.
     * 
     * @return int Cart ID
     */
    public function getCartId() {
        return $this->cart_id;
    }

    /**
     * Get the user ID.
     * 
     * @return int User ID
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * Destructor to unset all properties.
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
