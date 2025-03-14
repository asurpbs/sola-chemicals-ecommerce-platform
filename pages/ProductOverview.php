<?php
require $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
global $conn;

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id <= 0) {
    header("Location: index.php?page=product");
    exit();
}

// Fetch product details
$sql = "SELECT i.*, c.name as category_name 
        FROM item i 
        LEFT JOIN category c ON i.category_id = c.id 
        WHERE i.id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: index.php?page=product");
    exit();
}

// Get image path
$imagePath = "/uploads/product/" . ($product['image'] ? $product['image'] : 'default.png');
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
    $imagePath = "/uploads/product/null.png";
}
?>
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
            </div>
            <div class="col-md-6">
                <div class="small mb-1"><?php echo htmlspecialchars($product['category_name']); ?></div>
                <h1 class="display-5 fw-bolder"><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="fs-5 mb-5">
                    <?php if ($product['discount_rate'] > 0): ?>
                        <span class="text-decoration-line-through">Rs.<?php echo number_format($product['UP'], 2); ?></span>
                        <span>Rs.<?php echo number_format($product['UP'] * (1 - $product['discount_rate']/100), 2); ?></span>
                    <?php else: ?>
                        <span>Rs.<?php echo number_format($product['UP'], 2); ?></span>
                    <?php endif; ?>
                </div>
                <p class="lead">Stock Available: <?php echo $product['QoH']; ?></p>
                <?php if (!empty($product['description'])): ?>
                    <p class="lead"><?php echo htmlspecialchars($product['description']); ?></p>
                <?php endif; ?>
                <div class="d-flex">
                    <?php if ($product['QoH'] > 0 && isset($_COOKIE['user_id'])): ?>
                        <button class="btn btn-outline-danger flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related items section-->
<style>
    .card:hover {
        transform: scale(1.05);
        transition: transform 0.5s;
    }
</style>
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4 text-center">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            // Fetch related products from same category
            $sql = "SELECT * FROM item 
                    WHERE category_id = ? AND id != ? 
                    LIMIT 4";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$product['category_id'], $product_id]);
            $related_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($related_products as $related): 
                $relatedImagePath = "/uploads/product/" . ($related['image'] ? $related['image'] : 'default.png');
                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $relatedImagePath)) {
                    $relatedImagePath = "/uploads/product/null.png";
                }
            ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <a href="index.php?page=ProductOverview&id=<?php echo $related['id']; ?>">
                            <img class="card-img-top" src="<?php echo $relatedImagePath; ?>" alt="<?php echo htmlspecialchars($related['name']); ?>" />
                        </a>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">
                                    <a href="index.php?page=ProductOverview&id=<?php echo $related['id']; ?>" class="text-decoration-none text-dark">
                                        <?php echo htmlspecialchars($related['name']); ?>
                                    </a>
                                </h5>
                                <?php if ($related['discount_rate'] > 0): ?>
                                    <span class="text-muted text-decoration-line-through">Rs.<?php echo number_format($related['UP'], 2); ?></span>
                                    <br>Rs.<?php echo number_format($related['UP'] * (1 - $related['discount_rate']/100), 2); ?>
                                <?php else: ?>
                                    Rs.<?php echo number_format($related['UP'], 2); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($related['QoH'] > 0 && isset($_COOKIE['user_id'])): ?>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
