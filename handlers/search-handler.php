<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/context/connect.php';

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$products = [];

if (!empty($search)) {
    $sql = "SELECT * FROM item WHERE name LIKE :search OR description LIKE :search";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%{$search}%";
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container" style="margin-top: 120px;">
    <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
    
    <?php if (empty($search)): ?>
        <div class="alert alert-info">Please enter a search term.</div>
    <?php elseif (empty($products)): ?>
        <div class="alert alert-info">No products found matching your search.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="/uploads/product/<?php echo htmlspecialchars($product['image']); ?>" 
                             class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><strong>Price: Rs. <?php echo number_format($product['UP'], 2); ?></strong></p>
                            <a href="index.php?page=ProductOverview&id=<?php echo $product['id']; ?>" 
                               class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
