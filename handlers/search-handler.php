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

<style>
    .hero-search {
        background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
        padding: 3rem 0;
        margin-bottom: 0;
        color: white;
    }
    .search-input-group {
        max-width: 600px;
        margin: 2rem auto;
    }
    .search-input {
        border-radius: 50px;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .min-vh-50 {
        min-height: 50vh; /* This ensures minimum height of 50% of viewport height */
    }
    .search-results-container {
        min-height: calc(100vh - 400px); /* Adjust this value based on your header/footer height */
        padding-bottom: 2rem;
    }
    /* ...existing style rules... */
</style>

<div class="main-content">
    <div class="hero-search">
        <div class="container">
            <div class="text-center">
                <h1 class="display-4 fw-bold mb-4">Find Your Perfect Product</h1>
                <div class="search-input-group">
                    <form action="index.php" method="GET" class="search-form" id="searchForm">
                        <input type="hidden" name="page" value="search">
                        <input type="text" name="q" class="form-control search-input" 
                               placeholder="Search products..." 
                               value="<?php echo htmlspecialchars($search); ?>"
                               id="searchInput"
                               autocomplete="off">
                        <button type="submit" class="search-button">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-2 search-results-container"> <!-- Added search-results-container class -->
        <?php if (!empty($search)): ?>
            <nav aria-label="breadcrumb" class="mt-2"> <!-- Added mt-2 class -->
                <ol class="breadcrumb mb-2"> <!-- Added mb-2 class -->
                    <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
                    <li class="breadcrumb-item active">Search Results</li>
                </ol>
            </nav>
        <?php endif; ?>

        <?php if (empty($search)): ?>
            <div class="text-center py-5">
                <i class="bi bi-search display-1 text-muted"></i>
                <p class="lead mt-3">Start your search to discover our products</p>
            </div>
        <?php elseif (empty($products)): ?>
            <div class="text-center py-5 min-vh-50">
                <i class="bi bi-emoji-frown display-1 text-muted"></i>
                <h3 class="mt-4">No results found</h3>
                <p class="lead text-muted">Try different keywords or browse our categories</p>
            </div>
        <?php else: ?>
            <div class="filter-section">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">Showing <?php echo count($products); ?> results for "<?php echo htmlspecialchars($search); ?>"</p>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Sort by
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                            <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                            <li><a class="dropdown-item" href="#">Newest First</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="col">
                        <div class="card h-100 product-card">
                            <img src="/uploads/product/<?php echo htmlspecialchars($product['image']); ?>" 
                                 class="product-image"
                                 alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body d-flex flex-column">
                                <h5 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="product-description"><?php echo substr(htmlspecialchars($product['description']), 0, 100); ?>...</p>
                                <div class="price-tag mt-auto">
                                    Rs. <?php echo number_format($product['UP'], 2); ?>
                                </div>
                                <a href="index.php?page=ProductOverview&id=<?php echo $product['id']; ?>" 
                                   class="btn btn-primary view-details-btn">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('searchForm').addEventListener('submit', function(e) {
    const searchTerm = document.getElementById('searchInput').value.trim();
    if (!searchTerm) {
        e.preventDefault();
    }
});
</script>
