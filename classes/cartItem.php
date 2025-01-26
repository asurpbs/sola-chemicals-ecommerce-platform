<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class CartItem {
    private $cartItem_id;
    private $cart_id;
    private $item_id;
    private $quantity;
    private $image;

    /**
     * Constructor to create a new cart item or retrieve an existing cart item.
     * 
     * @param int|null $cartItem_id Cart item ID
     * @param int|null $cart_id Cart ID
     * @param int|null $item_id Item ID
     * @param int|null $quantity Quantity
     */
    public function __construct($cartItem_id = null, $cart_id = null, $item_id = null, $quantity = null) {
        global $conn;
        if ($cartItem_id) {
            $this->cartItem_id = $cartItem_id;
            $stmt = $conn->prepare("SELECT cart_id, item_id, quantity FROM cart_item WHERE id = ?");
            $stmt->bindValue(1, $this->cartItem_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->cart_id);
            $stmt->bindColumn(2, $this->item_id);
            $stmt->bindColumn(3, $this->quantity);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        } else {
            $this->cart_id = $cart_id;
            $this->item_id = $item_id;
            $this->quantity = $quantity;
            // Insert cart item data
            $stmt = $conn->prepare("INSERT INTO cart_item (cart_id, item_id, quantity) VALUES (?, ?, ?)");
            $stmt->bindValue(1, $this->cart_id);
            $stmt->bindValue(2, $this->item_id);
            $stmt->bindValue(3, $this->quantity);
            $stmt->execute();
            $stmt = null;
        }
    }

    /**
     * Update the quantity of the cart item.
     * 
     * @param int $quantity Quantity
     */
    public function updateQuantity($quantity) {
        global $conn;
        $this->quantity = $quantity;
        $stmt = $conn->prepare("UPDATE cart_item SET quantity = ? WHERE cart_id = ? AND item_id = ?");
        $stmt->bindValue(1, $this->quantity);
        $stmt->bindValue(2, $this->cart_id);
        $stmt->bindValue(3, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the cart item.
     */
    public function delete() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM cart_item WHERE cart_id = ? AND item_id = ?");
        $stmt->bindValue(1, $this->cart_id);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Get the quantity of the cart item.
     * 
     * @return int Quantity
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Get the item ID.
     * 
     * @return int Item ID
     */
    public function getItemId() {
        return $this->item_id;
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
     * Get the image of the item.
     * 
     * @return string Image
     */
    public function getImage() {
        global $conn;
        $stmt = $conn->prepare("SELECT image FROM item WHERE id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt->bindColumn(1, $this->image);
        $stmt->fetch(PDO::FETCH_BOUND);
        $stmt = null;
        return $this->image;
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
