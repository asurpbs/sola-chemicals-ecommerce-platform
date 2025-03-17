<?php
// Check the current page to set the active class dynamically
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Optionally, you can include Bootstrap or other stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Optional: Include Bootstrap Icons (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-light vh-100 sidebar position-fixed" id="sticky-sidebar">
        <div class="p-3">
            <!-- Sidebar Header -->
            <div class="text-center mb-4">
                <img src="/public/Main-Logo.svg" alt="Admin Logo" style="width: 100px; height: auto;">
                <h4 class="mt-2">
                    Admin Dashboard
                </h4>
            </div>
            
            <!-- Navigation Links -->
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : 'text-light'; ?>" href="dashboard.php">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'manage_product.php') ? 'active' : 'text-light'; ?>" href="manage_product.php">
                        <i class="bi bi-bar-chart me-2"></i> Manage Product
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'orders.php') ? 'active' : 'text-light'; ?>" href="orders.php">
                        <i class="bi bi-people me-2"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'user_management.php') ? 'active' : 'text-light'; ?>" href="user_management.php">
                        <i class="bi bi-gear me-2"></i> User Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'settings.php') ? 'active' : 'text-light'; ?>" href="settings.php">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>
                </li>
            </ul>
            
            <hr class="text-light">
            
            <!-- Profile & Logout -->
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'profile.php') ? 'active' : 'text-light'; ?>" href="profile.php">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="logout.php">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 main-content">
        <?php
        // Check which page is being requested and include the relevant content
        if ($current_page == 'dashboard.php') {
            include('dashboard_content.php'); // Dashboard content
        } elseif ($current_page == 'manage_product.php') {
            include('manage_content.php'); 
        } elseif ($current_page == 'orders.php') {
            include('orders_content.php'); 
        } elseif ($current_page == 'user_management.php') {
            include('user_manage_content.php'); 
        } elseif ($current_page == 'settings.php') {
            include('settings_content.php'); 
        } elseif ($current_page == 'profile.php') {
            include('profile_content.php');
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
