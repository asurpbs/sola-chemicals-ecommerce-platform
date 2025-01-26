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
    private $availability;
    private $delivery_method_id;
    private $views;

    /**
     * Constructor to create a new item or retrieve an existing item.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of item by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new item
     *      eg - new Item(null, "Item Name", "image.jpg", 1, 10, 100.00, 10.00, 1, 1)
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new item 
     *      when the item already exists.
     *      eg - new Item(1)
     * 
     * @param int|null $item_id Item ID
     * @param string|null $name Item name
     * @param string|null $image Item image
     * @param int|null $category_id Category ID
     * @param int|null $QoH Quantity on Hand
     * @param float|null $UP Unit Price
     * @param float|null $discount_rate Discount rate
     * @param int|null $availability Availability
     * @param int|null $delivery_method_id Delivery method ID
     */
    public function __construct($item_id = null, $name = null, $image = null, $category_id = null, $QoH = null, $UP = null, $discount_rate = null, $availability = null, $delivery_method_id = null) {
        global $conn;
        if ($item_id === null) {
            $this->name = ucwords(trim($name));
            $this->image = fileUpload("item");
            $this->category_id = $category_id;
            $this->QoH = $QoH;
            $this->UP = $UP;
            $this->discount_rate = $discount_rate;
            $this->availability = $availability;
            $this->delivery_method_id = $delivery_method_id;

            // Insert item data
            $stmt = $conn->prepare("INSERT INTO item (name, image, category_id, QoH, UP, discount_rate, availability, delivery_method_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $this->name);
            $stmt->bindValue(2, $this->image);
            $stmt->bindValue(3, $this->category_id);
            $stmt->bindValue(4, $this->QoH);
            $stmt->bindValue(5, $this->UP);
            $stmt->bindValue(6, $this->discount_rate);
            $stmt->bindValue(7, $this->availability);
            $stmt->bindValue(8, $this->delivery_method_id);
            $stmt->execute();
            $this->item_id = $conn->lastInsertId();
            $stmt = null;
        } else {
            $this->item_id = $item_id;

            // Retrieve item data
            $stmt = $conn->prepare("SELECT name, image, category_id, QoH, UP, discount_rate, availability, delivery_method_id, views FROM item WHERE id = ?");
            $stmt->bindValue(1, $this->item_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->name);
            $stmt->bindColumn(2, $this->image);
            $stmt->bindColumn(3, $this->category_id);
            $stmt->bindColumn(4, $this->QoH);
            $stmt->bindColumn(5, $this->UP);
            $stmt->bindColumn(6, $this->discount_rate);
            $stmt->bindColumn(7, $this->availability);
            $stmt->bindColumn(8, $this->delivery_method_id);
            $stmt->bindColumn(9, $this->views);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
            $this->image = fileGet("item", $this->image);
        }
    }

    /**
     * Update the name of the item.
     * 
     * @param string $name Name
     */
    public function updateName($name) {
        global $conn;
        $this->name = ucwords(trim($name));
        $stmt = $conn->prepare("UPDATE item SET name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the image of the item.
     * 
     * @param string $image Image
     */
    public function updateImage($image) {
        global $conn;
        // Delete image file if it's not null.png
        fileDelete($this->image);
        // update the name of image in this class
        $this->image = fileUpload($image);
        $stmt = $conn->prepare("UPDATE item SET image = ? WHERE id = ?");
        $stmt->bindValue(1, $this->image);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the category ID of the item.
     * 
     * @param int $category_id Category ID
     */
    public function updateCategoryId($category_id) {
        global $conn;
        $this->category_id = $category_id;
        $stmt = $conn->prepare("UPDATE item SET category_id = ? WHERE id = ?");
        $stmt->bindValue(1, $this->category_id);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the quantity on hand of the item.
     * 
     * @param int $QoH Quantity on Hand
     */
    public function updateQoH($QoH) {
        global $conn;
        $this->QoH = $QoH;
        $stmt = $conn->prepare("UPDATE item SET QoH = ? WHERE id = ?");
        $stmt->bindValue(1, $this->QoH);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the unit price of the item.
     * 
     * @param float $UP Unit Price
     */
    public function updateUP($UP) {
        global $conn;
        $this->UP = $UP;
        $stmt = $conn->prepare("UPDATE item SET UP = ? WHERE id = ?");
        $stmt->bindValue(1, $this->UP);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the discount rate of the item.
     * 
     * @param float $discount_rate Discount rate
     */
    public function updateDiscountRate($discount_rate) {
        global $conn;
        $this->discount_rate = $discount_rate;
        $stmt = $conn->prepare("UPDATE item SET discount_rate = ? WHERE id = ?");
        $stmt->bindValue(1, $this->discount_rate);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the availability of the item.
     * 
     * @param int $availability Availability
     */
    public function updateAvailability($availability) {
        global $conn;
        $this->availability = $availability;
        $stmt = $conn->prepare("UPDATE item SET availability = ? WHERE id = ?");
        $stmt->bindValue(1, $this->availability);
        $stmt->bindValue(2, $this->item_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Get the name of the item.
     * 
     * @return string Name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get the image of the item.
     * 
     * @return string Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Get the category ID of the item.
     * 
     * @return int Category ID
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Get the quantity on hand of the item.
     * 
     * @return int Quantity on Hand
     */
    public function getQoH() {
        return $this->QoH;
    }

    /**
     * Get the unit price of the item.
     * 
     * @return float Unit Price
     */
    public function getUP() {
        return $this->UP;
    }

    /**
     * Get the discount rate of the item.
     * 
     * @return float Discount rate
     */
    public function getDiscountRate() {
        return $this->discount_rate;
    }

    /**
     * Get the availability of the item.
     * 
     * @return int Availability
     */
    public function getAvailability() {
        return $this->availability;
    }

    /**
     * Delete the item.
     */
    public function deleteItem() {
        global $conn;
        // Delete image file if it's not null.png
        fileDelete($this->image);

        // Set foreign key references to null
        $stmt = $conn->prepare("UPDATE order SET item_id = NULL WHERE item_id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt = null;

        // Delete item data
        $stmt = $conn->prepare("DELETE FROM item WHERE id = ?");
        $stmt->bindValue(1, $this->item_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Get the total number of items.
     * 
     * @return int Total items
     */
    public static function getNoTotalItems() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM item");
        $stmt->execute();
        $total_items = $stmt->fetchColumn();
        $stmt = null;
        return $total_items;
    }

    /**
     * Get all items as an object array.
     * 
     * @return array Items
     */
    public static function getAllItems() {
        global $conn;
        $items = [];
        $stmt = $conn->prepare("SELECT id FROM item");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $items[] = new self($row['id']);
        }
        $stmt = null;
        return $items;
    }

    /**
     * Use to delete the instance of item
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>