<?php
session_start();
include('../context/connect.php');

// Handle Add, Edit, and Delete Operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $category = $_POST['category'];
        $Up = $_POST['UP'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $availability = $_POST['availability'];
        
        // Image Upload
        $imageName = basename($_FILES['image']['name']); // Sanitize filename
        $targetDirectory = "../uploads/product/"; // Note the trailing slash
        $targetPath = $targetDirectory . $imageName;

        // Create directory if it doesn't exist
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }

        // Move uploaded file with error checking
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            // File uploaded successfully
            echo "Image uploaded to: " . $targetPath;
        } else {
            // Handle upload error
            echo "Error uploading file. Check permissions and directory structure.";
        }

        $stmt = $conn->prepare("INSERT INTO item (name, category_id, Up, QoH, description, image, availability) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $category, $Up, $stock, $description, $imageName, $availability]);
    }
    
    if (isset($_POST['edit_product'])) {
        // Check if the necessary data is passed
        if (isset($_POST['id'], $_POST['name'], $_POST['category'], $_POST['UP'], $_POST['stock'], $_POST['description'], $_POST['availability'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $Up = $_POST['UP'];
            $stock = $_POST['stock'];
            $description = $_POST['description'];
            $availability = $_POST['availability'];

            // Update the product in the database
            $stmt = $conn->prepare("UPDATE item SET name=?, category_id=?, Up=?, QoH=?, description=?, availability=? WHERE id=?");
            $stmt->execute([$name, $category, $Up, $stock, $description, $availability, $id]);
        } else {
            echo "<script>alert('Error: Some fields are missing.');</script>";
        }
    }

    if (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM item WHERE id=?");
        $stmt->execute([$id]);
    }
}

// Fetch Products
$products = $conn->query("SELECT i.*, c.name AS category FROM item i JOIN category c ON i.category_id = c.id")->fetchAll(PDO::FETCH_ASSOC);
$categories = $conn->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Products</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
    <table class="table table-striped" id="productTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price (Rs)</th>
                <th>Stock</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['category']) ?></td>
                <td><?= number_format($product['UP'], 2) ?></td>
                <td><?= $product['QoH'] ?></td>
                <td><?= $product['availability'] ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Not Available</span>' ?></td>
                <td>
                    <!-- Edit Button -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal" 
                            data-id="<?= $product['id'] ?>" 
                            data-name="<?= htmlspecialchars($product['name']) ?>" 
                            data-category="<?= $product['category_id'] ?>" 
                            data-up="<?= $product['UP'] ?>" 
                            data-stock="<?= $product['QoH'] ?>" 
                            data-description="<?= htmlspecialchars($product['description']) ?>" 
                            data-availability="<?= $product['availability'] ?>">Edit</button>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <button type="submit" name="delete_product" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="UP" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Availability</label>
                        <select name="availability" class="form-control">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category" id="editCategory" class="form-control">
                            <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="UP" id="editUp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="number" name="stock" id="editStock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" id="editDescription" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Availability</label>
                        <select name="availability" id="editAvailability" class="form-control">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>
                    <button type="submit" name="edit_product" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Script for editing product
    document.querySelectorAll('.btn-warning').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const category = this.getAttribute('data-category');
            const up = this.getAttribute('data-up');
            const stock = this.getAttribute('data-stock');
            const description = this.getAttribute('data-description');
            const availability = this.getAttribute('data-availability');
            
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editCategory').value = category;
            document.getElementById('editUp').value = up;
            document.getElementById('editStock').value = stock;
            document.getElementById('editDescription').value = description;
            document.getElementById('editAvailability').value = availability;
        });
    });

    // Initialize DataTable
    $(document).ready(function () {
        $('#productTable').DataTable();
    });
</script>

</body>
</html>
