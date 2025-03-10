<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order History</title>
    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <style>
        .order-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
        }

        .order-status {
            font-size: 0.9rem;
        }

        .order-actions button {
            margin-left: 10px;
        }
    </style>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Order History</h2>
        <a href="/index.php" class="btn btn-outline-secondary mb-4">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>

        <!-- Order Filter Options -->
        <div class="d-flex justify-content-between mb-4">
            <div>
                <span>View:</span>
                <select class="form-select d-inline w-auto">
                    <option>All categories</option>
                    <option>Helth Care Products</option>
                    <option>House Hold Products</option>
                    <option>Car Care Products</option>
                    <option>Industrial Chemicals</option>
                </select>
            </div>
            <div>
                <span>Ordered within:</span>
                <select class="form-select d-inline w-auto">
                    <option>Past 3 months</option>
                    <option>Past 6 months</option>
                    <option>Past year</option>
                </select>
            </div>
        </div>

        <!-- Order Card 1 -->
        <div class="order-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5>Order #1234</h5>
                    <p class="text-muted mb-1">March 16, 2021 | Paid with Mastercard **6985</p>
                </div>
                <div class="text-end">
                    <p class="text-primary mb-1">In transit</p>
                    <p class="text-muted">Estimated delivery: April 10, 2021</p>
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/80" alt="Product" class="img-thumbnail me-3" style="width: 80px; height: 80px;">
                <div>
                    <p class="fw-bold mb-1">Washing powder 1Kg x 25</p>
                    <p class="text-muted mb-0">Total: LKR 7500</p>
                </div>
            </div>
            <hr>
            <div class="order-actions d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-primary btn-sm">Track order</button>
                    <button class="btn btn-outline-secondary btn-sm">Request return</button>
                </div>
                <button class="btn btn-outline-primary btn-sm">Show details</button>
            </div>
        </div>

        <!-- Order Card 2 -->
        <div class="order-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5>Order #1235</h5>
                    <p class="text-muted mb-1">March 10, 2021 | Paid with Mastercard **6985</p>
                </div>
                <div class="text-end">
                    <p class="text-success mb-1">Completed</p>
                    <p class="text-muted">Delivered on March 12, 2022</p>
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/80" alt="Product" class="img-thumbnail me-3" style="width: 80px; height: 80px;">
                <div>
                    <p class="fw-bold mb-1">Dish Wash 4L x 1 / Car Wash 10L x 1</p>
                    <p class="text-muted mb-0">Total: LKR 4360</p>
                </div>
            </div>
            <hr>
            <div class="order-actions d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-primary btn-sm">Buy again</button>
                </div>
                <button class="btn btn-outline-primary btn-sm">Show details</button>
            </div>
        </div>

        <!-- Order Card 3 -->
        <div class="order-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5>Order #1236</h5>
                    <p class="text-muted mb-1">March 5, 2021 | Paid with PayPal</p>
                </div>
                <div class="text-end">
                    <p class="text-danger mb-1">Order Cancelled</p>
                    <p class="text-muted">Delivered on March 8, 2022</p>
                </div>
            </div>
            <hr>
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/80" alt="Product" class="img-thumbnail me-3" style="width: 80px; height: 80px;">
                <div>
                    <p class="fw-bold mb-1">Mario Cart Edition 6</p>
                    <p class="text-muted mb-0">Total: $70.00</p>
                </div>
            </div>
            <hr>
            <div class="order-actions d-flex justify-content-between">
                <div>
                    <button class="btn btn-outline-primary btn-sm">Buy again</button>
                </div>
                <button class="btn btn-outline-primary btn-sm">Show details</button>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">This site is under the maintance &copy; Hash coders 2025</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
