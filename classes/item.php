<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Item {
    private $item_id;
    private $name;
    private $image;
    private $category_id;
    private $QoH;
    private $UP;
    private $discount_rate;
    private $delivery_method_id;

    /**
     * input the file path by fileUpload()
     */
    public function __construct($item_id = null, $name = null, $image = null, $category_id = null, $QoH = null, $UP = null, $discount_rate = null, $delivery_method_id = null) {
        global $conn;
        if ($item_id === null) {
            $this->name = ucwords(trim($name));
            $this->image = $image;
            $this->category_id = $category_id;
            $this->QoH = $QoH;
            $this->UP = $UP;
            $this->discount_rate = $discount_rate;
            $this->delivery_method_id = $delivery_method_id;

            // Insert item data
            $stmt = $conn->prepare("INSERT INTO item (name, image, category_id, QoH, UP, discount_rate, delivery_method_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->name);
            $stmt->bindValue(2, $this->image);
            $stmt->bindValue(3, $this->category_id);
            $stmt->bindValue(4, $this->QoH);
            $stmt->bindValue(5, $this->UP);
            $stmt->bindValue(6, $this->discount_rate);
            $stmt->bindValue(7, $this->delivery_method_id);
            $stmt->execute();
            $this->item_id = $conn->lastInsertId();
            $stmt = null;

            require_once "../utils/image.php";
            fileUpload("item");
        } else {
            $this->item_id = $item_id;

            // Retrieve item data
            $stmt = $conn->prepare("SELECT name, image, category_id, QoH, UP, discount_rate, delivery_method_id FROM item WHERE id = ?");
            $stmt->bindValue(1, $this->item_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->name);
            $stmt->bindColumn(2, $this->image);
            $stmt->bindColumn(3, $this->category_id);
            $stmt->bindColumn(4, $this->QoH);
            $stmt->bindColumn(5, $this->UP);
            $stmt->bindColumn(6, $this->discount_rate);
            $stmt->bindColumn(7, $this->delivery_method_id);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    public function updateName($name) {
        global $conn;
        $this->name = ucwords(trim($name));
        $stmt = $conn->prepare("UPDATE item SET name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateImage($image) {
        global $conn;
        require_once "../utils/image.php";
        // delete existing image if it's not null.png
        $currentImagePath = fileGet("item", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }
        // update the name of image in this class
        $this->image = fileUpload($image);
        $stmt = $conn->prepare("UPDATE item SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateCategoryId($category_id) {
        global $conn;
        $this->category_id = $category_id;
        $stmt = $conn->prepare("UPDATE item SET category_id = ? WHERE id = ?");
        $stmt->bindValue(1, $this->category_id);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateQoH($QoH) {
        global $conn;
        $this->QoH = $QoH;
        $stmt = $conn->prepare("UPDATE item SET QoH = ? WHERE id = ?");
        $stmt->bindValue(1, $this->QoH);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateUP($UP) {
        global $conn;
        $this->UP = $UP;
        $stmt = $conn->prepare("UPDATE item SET UP = ? WHERE id = ?");
        $stmt->bindValue(1, $this->UP);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateDiscountRate($discount_rate) {
        global $conn;
        $this->discount_rate = $discount_rate;
        $stmt = $conn->prepare("UPDATE item SET discount_rate = ? WHERE id = ?");
        $stmt->bindValue(1, $this->discount_rate);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function updateDeliveryMethodId($delivery_method_id) {
        global $conn;
        $this->delivery_method_id = $delivery_method_id;
        $stmt = $conn->prepare("UPDATE item SET delivery_method_id = ? WHERE id = ?");
        $stmt->bindValue(1, $this->delivery_method_id);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    public function deleteItem() {
        global $conn;
        require_once "../utils/image.php";

        // Set foreign key references to null
        $stmt = $conn->prepare("UPDATE cart SET item_id = NULL WHERE item_id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt = null;

        $stmt = $conn->prepare("UPDATE `order` SET item_id = NULL WHERE item_id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt = null;

        // Delete item data
        $stmt = $conn->prepare("DELETE FROM item WHERE id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt = null;

        // Delete image file if it's not null.png
        $currentImagePath = fileGet("item", $this->image);
        if (basename($currentImagePath) !== 'null.png') {
            unlink($_SERVER['DOCUMENT_ROOT'].$currentImagePath);
        }

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getQoH() {
        return $this->QoH;
    }

    public function getUP() {
        return $this->UP;
    }

    public function getDiscountRate() {
        return $this->discount_rate;
    }

    public function getDeliveryMethodId() {
        return $this->delivery_method_id;
    }

    public function getItemId() {
        return $this->item_id;
    }
}
?>
