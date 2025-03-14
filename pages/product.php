<!-- Header -->
<?php
require $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
global $conn;
$is_logged_in = isset($_COOKIE['user_id']);
?>
<header class="bg-gradient bg-dark py-4 py-sm-5 mb-4 mb-sm-5 position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: url('/assets/img/pattern.svg') repeat; opacity: 0.1;"></div>
    <div class="container px-3 px-lg-5 my-4 my-sm-5 position-relative">
        <div class="text-center text-white">
            <h1 class="display-5 display-md-4 fw-bolder text-uppercase mb-2">Our Products</h1>
            <p class="lead fw-normal text-white-50 mb-0 small-md">Discover our quality products for your needs</p>
        </div>
    </div>
</header>

<div class="container mb-4 mb-sm-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded-4 p-2 p-sm-3 mb-4 mb-sm-5">
                <div class="container-fluid">
                    <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#productNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="productNav">
                        <ul class="navbar-nav mx-auto gap-2 gap-sm-3">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold px-3 rounded-pill" href="#">All Products</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold px-3" data-bs-toggle="dropdown" href="#" role="button">
                                    Categories
                                </a>
                                <ul class="dropdown-menu border-0 shadow-sm">
                                    <li><a class="dropdown-item" href="#">Health Care Products</a></li>
                                    <li><a class="dropdown-item" href="#">Household Products</a></li>
                                    <li><a class="dropdown-item" href="#">Car Care Items</a></li>
                                    <li><a class="dropdown-item" href="#">Industrial Chemicals</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">New Products</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="row g-3 g-sm-4 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
        <?php
        $sql = "SELECT id, name, image, UP, QoH, discount_rate, availability FROM item";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            foreach($result as $row) {
                ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm product-card overflow-hidden <?php echo ($row['QoH'] == 0) ? 'bg-light' : ''; ?>">
                        <?php if ($row['QoH'] == 0) { ?>
                            <div class="badge bg-danger position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill">Out of Stock</div>
                        <?php } else if ($row['discount_rate'] > 0) { ?>
                            <div class="badge bg-success position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill"><?php echo $row['discount_rate']; ?>% Off</div>
                        <?php } ?>
                        
                        <div class="position-relative product-img-wrapper bg-light">
                            <a href="index.php?page=ProductOverview&id=<?php echo $row['id']; ?>" 
                               class="product-link <?php echo ($row['QoH'] == 0) ? 'opacity-50' : ''; ?>">
                                <?php 
                                $imagePath = "/uploads/product/" . ($row['image'] ? $row['image'] : 'default.png');
                                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
                                    $imageUrl = $imagePath;
                                } else {
                                    $imageUrl = "/uploads/product/null.png";
                                }
                                ?>
                                <img class="card-img-top p-3" src="<?php echo $imageUrl; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" />
                            </a>
                        </div>
                        
                        <div class="card-body p-4">
                            <h5 class="fw-bold product-title mb-3">
                                <a href="index.php?page=ProductOverview&id=<?php echo $row['id']; ?>" 
                                   class="text-decoration-none text-dark stretched-link">
                                    <?php echo $row['name']; ?>
                                </a>
                            </h5>
                            <div class="mb-3">
                                <?php if ($row['QoH'] == 0) { ?>
                                    <span class="text-muted">Rs. <?php echo number_format($row['UP'], 2); ?></span>
                                <?php } else if ($row['discount_rate'] > 0) { ?>
                                    <span class="text-muted text-decoration-line-through me-2">Rs. <?php echo number_format($row['UP'], 2); ?></span>
                                    <span class="text-danger fw-bold">Rs. <?php echo number_format($row['UP'] * (1 - $row['discount_rate']/100), 2); ?></span>
                                <?php } else { ?>
                                    <span class="fw-bold">Rs. <?php echo number_format($row['UP'], 2); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <?php if($row['QoH'] > 0 && $is_logged_in) { ?>
                                <div class="mt-4">
                                    <button class="btn btn-primary w-100" onclick="addToCart(<?php echo $row['id']; ?>)">
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </div>
                            <?php } else if($row['QoH'] == 0) { ?>
                                <div class="text-center mt-4">
                                    <span class="text-danger">
                                        <i class="bi bi-x-circle me-2"></i>Out of Stock
                                    </span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }
        } else {
            echo "<p class='text-center'>No products found</p>";
        } ?>
    </div>
</div>

<style>
.product-card {
    transition: all 0.3s ease;
    border-radius: 1rem;
}
.product-card:hover {
    transform: translateY(-5px);
}
.product-img-wrapper {
    padding: 2rem;
    transition: background-color 0.3s ease;
}
.product-card:hover .product-img-wrapper {
    background-color: #f8f9fa;
}
.product-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.8em;
}
.nav-link.active {
    background-color: var(--bs-primary);
    color: white !important;
}
.product-link {
    display: block;
    overflow: hidden;
}
.product-link img {
    transition: transform 0.3s ease-in-out;
}
.product-link:hover img {
    transform: scale(1.05);
}

@media (max-width: 575.98px) {
    .product-card {
        border-radius: 0.75rem;
    }
    .product-img-wrapper {
        padding: 1rem;
    }
    .product-title {
        font-size: 0.9rem;
        height: 2.4em;
    }
    .card-body {
        padding: 1rem !important;
    }
    .card-footer {
        padding: 0.75rem !important;
    }
    .btn {
        padding: 0.5rem;
        font-size: 0.875rem;
    }
    .btn i {
        font-size: 0.875rem;
    }
    .input-group-sm>.btn, 
    .input-group-sm>.input-group-text, 
    .input-group-sm>.form-control {
        padding: 0.25rem 0.5rem;
    }
    .badge {
        font-size: 0.7rem;
    }
}

@media (max-width: 767.98px) {
    .small-md {
        font-size: 0.9rem;
    }
    .display-5 {
        font-size: calc(1.2rem + 1.5vw);
    }
}
</style>

<script>
function addToCart(itemId) {
    const userId = $_COOKIE['user_id'];

    if (!userId) {
        alert('Please log in to add items to cart');
        return;
    }

    fetch('ajax/cart_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=add&item_id=${itemId}&quantity=1&user_id=${userId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Item added to cart successfully!');
        } else {
            alert(data.message || 'Failed to add item to cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding to cart');
    });
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

function updateQuantity(itemId, action) {
    const input = document.getElementById('quantity_' + itemId);
    const currentValue = parseInt(input.value);
    const maxValue = parseInt(input.max);
    
    if (action === 'increase' && currentValue < maxValue) {
        input.value = currentValue + 1;
    } else if (action === 'decrease' && currentValue > 1) {
        input.value = currentValue - 1;
    }
}
</script>