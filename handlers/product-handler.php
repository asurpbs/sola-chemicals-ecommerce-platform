<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/context/connect.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    $sql = "SELECT * FROM item WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product): ?>
        <div class="container" style="margin-top: 120px;">
            <div class="row">
                <div class="col-md-6">
                    <img src="/uploads/product/<?php echo htmlspecialchars($product['image']); ?>" 
                         class="img-fluid rounded" 
                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="col-md-6">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p class="text-muted"><?php echo htmlspecialchars($product['description'] ?? ''); ?></p>
                    <h3 class="text-primary">Rs. <?php echo number_format($product['UP'], 2); ?></h3>
                    
                    <?php if ($product['availability'] && $product['QoH'] > 0): ?>
                        <p class="text-success">In Stock (<?php echo $product['QoH']; ?> available)</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="addToCart(<?php echo $product['id']; ?>)">
                                Add to Cart
                            </button>
                        </div>
                    <?php else: ?>
                        <p class="text-danger">Out of Stock</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">Product not found.</div>
    <?php endif;
} else {
    echo '<div class="alert alert-danger">Invalid product ID.</div>';
}
?>
