<!-- Header -->
<?php
require $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
global $conn;
?>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="d-flex justify-content-center text-white">
            <h1 class="display-4 fw-bolder">Our Products</h1>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="nav nav-pills nav-justified">
    <a class="nav-item nav-link active" href="#">All Products</a>
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Item Categories</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Health Care Products</a>
            <a class="dropdown-item" href="#">Household Products</a>
            <a class="dropdown-item" href="#">Car Care Items</a>
            <a class="dropdown-item" href="#">Industrial Chemicals</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">New Products</a>
        </div>
    </div>
</nav>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $sql = "SELECT id, name, image, UP, QoH, discount_rate, availability FROM item";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                foreach($result as $row) {
                    ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <?php if ($row['QoH'] == 0) { ?>
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Out of stock</div>
                            <?php } else if ($row['discount_rate'] > 0) { ?>
                                <div class="badge bg-success text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo $row['discount_rate']; ?>% Off</div>
                            <?php } ?>
                            
                            <!-- Product image-->
                            <a href="./pages/ProductOverview.html?id=<?php echo $row['id']; ?>">
                                <img class="card-img-top" src="./uploads/product/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" />
                            </a>
                            
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $row['name']; ?></h5>
                                    
                                    <!-- Product price-->
                                    <?php if ($row['discount_rate'] > 0) { ?>
                                        <span class="text-muted text-decoration-line-through">Rs. <?php echo number_format($row['UP'], 2); ?></span>
                                        <br>
                                        Rs. <?php echo number_format($row['UP'] * (1 - $row['discount_rate']/100), 2); ?>
                                    <?php } else { ?>
                                        Rs. <?php echo number_format($row['UP'], 2); ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <?php if ($row['QoH'] > 0 && isset($_COOKIE['user_id'])) { ?>
                                        <a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>No products found</p>";
            }
            ?>
        </div>
    </div>
</section>