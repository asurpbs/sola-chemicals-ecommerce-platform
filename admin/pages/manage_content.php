<?php
// Include the database connection
include('../context/connect.php');

// Ensure $pdo is defined
if (!isset($pdo)) {
    die("Database connection failed");
}

// Check the current page to set the active class dynamically
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="container">
    <h2>Manage Products</h2>
    <p>Welcome to the product management section. Here you can manage existing products, update details, or remove them.</p>

    <!-- Example table to display products -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity on Hand (QoH)</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                // Fetch products from the 'item' table using PDO
                $sql = "SELECT id, name, UP AS price, QoH, availability FROM item"; // Updated column names
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($items) {
                    foreach ($items as $item) {
                        // Check availability
                        $availability = ($item['availability'] == 1) ? 'Available' : 'Not Available';
                        echo "<tr>
                            <td>{$item['id']}</td>
                            <td>{$item['name']}</td>
                            <td>\${$item['price']}</td>
                            <td>{$item['QoH']}</td>
                            <td>{$availability}</td>
                            <td>
                                <a href='edit_product.php?id={$item['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_product.php?id={$item['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found</td></tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</div>
