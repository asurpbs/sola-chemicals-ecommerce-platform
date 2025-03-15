<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/context/connect.php';

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$products = [];

if (!empty($search)) {
    $sql = "SELECT * FROM item WHERE 
            name LIKE :search OR 
            description LIKE :search";
            
    $stmt = $conn->prepare($sql);
    $searchTerm = "%{$search}%";
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Results</title>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/components/metadata.html'; ?>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1 0 auto;
            margin-top: 76px; /* Adjust based on your header height */
        }
        .hero-search {
            background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);
            padding: 3rem 0;
            margin-bottom: 0;
            color: white;
        }
        footer {
            flex-shrink: 0;
            margin-top: auto;
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
        .filter-section {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .product-grid {
            margin-top: 2rem;
        }
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 280px;
            object-fit: cover;
            background: #f8f9fa;
        }
        .card-body {
            padding: 1.5rem;
        }
        .product-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        .product-description {
            color: #718096;
            font-size: 0.9rem;
            line-height: 1.5;
        }
        .price-tag {
            font-size: 1.25rem;
            color: #4F46E5;
            font-weight: 700;
            margin: 1rem 0;
        }
        .view-details-btn {
            background: #4F46E5;
            border: none;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }
        .view-details-btn:hover {
            background: #4338CA;
            transform: translateY(-2px);
        }
        @media (max-width: 768px) {
            .hero-search {
                padding: 2rem 0;
            }
            .product-image {
                height: 220px;
            }
        }
        .search-form {
            width: 100%;
            position: relative;
        }
        .search-button {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            color: #4F46E5;
        }
    </style>
</head>
<body class="bg-light">
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/components/home-header.php'; ?>
    
    <div class="main-content">
        <div class="hero-search">
            <div class="container">
                <div class="text-center">
                    <h1 class="display-4 fw-bold mb-4">Find Your Perfect Product</h1>
                    <div class="search-input-group">
                        <form action="/pages/search.php" method="GET" class="search-form" id="searchForm">
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

        <div class="container py-4">
            <?php if (!empty($search)): ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
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
                <div class="text-center py-5">
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

    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/components/home-footer.php'; ?>
    <script src="/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="/assets/js/script.js"></script>
    <script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const searchTerm = document.getElementById('searchInput').value.trim();
        if (searchTerm) {
            const newUrl = `${window.location.pathname}?q=${encodeURIComponent(searchTerm)}`;
            window.history.pushState({ search: searchTerm }, '', newUrl);
            this.submit();
        }
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.search) {
            document.getElementById('searchInput').value = e.state.search;
        }
    });

    // Store initial state
    const initialSearch = new URLSearchParams(window.location.search).get('q');
    if (initialSearch) {
        window.history.replaceState({ search: initialSearch }, '', window.location.href);
    }
    </script>
</body>
</html>
