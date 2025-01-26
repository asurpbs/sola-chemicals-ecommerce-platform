<?php
include $_SERVER['DOCUMENT_ROOT']."/context/connect.php";

class Category {
    private $category_id;
    private $name;
    private $description;

    /**
     * Constructor to create a new category or retrieve an existing category.
     * Note - you must include the database connectivity file in your page and pass the $conn  
     *  You can create an instance of category by 2 ways.
     *  1) first argument of the constructor is null and rest are filled - to create a new category
     *      eg - new Category(null, "Category Name", "Category Description")
     *  2) first argument is filled and rest are null - to retrieve data from database and create a new category 
     *      when the category already exists.
     *      eg - new Category(1)
     * 
     * @param int|null $category_id Category ID
     * @param string|null $name Category name
     * @param string|null $description Category description
     */
    public function __construct($category_id = null, $name = null, $description = null) {
        global $conn;
        if ($category_id === null) {
            $this->name = ucwords(trim($name));
            $this->description = trim($description);

            // Insert category data
            $stmt = $conn->prepare("INSERT INTO category (name, description) VALUES (?, ?)");
            $stmt->bindValue(1, $this->name);
            $stmt->bindValue(2, $this->description);
            $stmt->execute();
            $this->category_id = $conn->lastInsertId();
            $stmt = null;
        } else {
            $this->category_id = $category_id;

            // Retrieve category data
            $stmt = $conn->prepare("SELECT name, description FROM category WHERE id = ?");
            $stmt->bindValue(1, $this->category_id);
            $stmt->execute();
            $stmt->bindColumn(1, $this->name);
            $stmt->bindColumn(2, $this->description);
            $stmt->fetch(PDO::FETCH_BOUND);
            $stmt = null;
        }
    }

    /**
     * Get all categories as an array.
     * 
     * @return array Categories
     */
    public static function getAllCategories() {
        global $conn;
        $categories = [];
        $stmt = $conn->prepare("SELECT id, name, description FROM category");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $row;
        }
        $stmt = null;
        return $categories;
    }

    /**
     * Get the total number of categories.
     * 
     * @return int Total categories
     */
    public static function getTotalCategories() {
        global $conn;
        $stmt = $conn->prepare("SELECT COUNT(id) FROM category");
        $stmt->execute();
        $total_categories = $stmt->fetchColumn();
        $stmt = null;
        return $total_categories;
    }

    /**
     * Get the category ID.
     * 
     * @return int Category ID
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Get the name of the category.
     * 
     * @return string Name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get the description of the category.
     * 
     * @return string Description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Update the name of the category.
     * 
     * @param string $name Name
     */
    public function updateName($name) {
        global $conn;
        $this->name = ucwords(trim($name));
        $stmt = $conn->prepare("UPDATE category SET name = ? WHERE id = ?");
        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->category_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Update the description of the category.
     * 
     * @param string $description Description
     */
    public function updateDescription($description) {
        global $conn;
        $this->description = trim($description);
        $stmt = $conn->prepare("UPDATE category SET description = ? WHERE id = ?");
        $stmt->bindValue(1, $this->description);
        $stmt->bindValue(2, $this->category_id);
        $stmt->execute();
        $stmt = null;
    }

    /**
     * Delete the category.
     */
    public function deleteCategory() {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM category WHERE id = ?");
        $stmt->bindValue(1, $this->category_id);
        $stmt->execute();
        $stmt = null;

        // Unset all properties
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    /**
     * Use to delete the instance of category
     */
    public function __destruct() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
}
?>
