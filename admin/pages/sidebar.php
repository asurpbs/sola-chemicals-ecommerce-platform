<?php
// Check the current page to set the active class dynamically
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-light vh-100 sidebar">
        <div class="p-3">
            <!-- Sidebar Header -->
            <div class="text-center mb-4">
                <img src="https://sola.lk/wp-content/uploads/2024/11/Main-Logo.svg" alt="Admin Logo" style="width: 100px; height: auto;">
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
                    <a class="nav-link <?php echo ($current_page == 'new_product.php') ? 'active' : 'text-light'; ?>" href="new_product.php">
                        <i class="bi bi-people me-2"></i> New Product
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
    <div class="flex-grow-1 p-4">
        <?php
        // Check which page is being requested and include the relevant content
        if ($current_page == 'dashboard.php') {
            include('../admin/pages/dashboard_content.php'); // Dashboard content
        } elseif ($current_page == 'manage_product.php') {
            include('../admin/pages/manage_content.php'); 
        } elseif ($current_page == 'new_product.php') {
            include('../admin/pages/newProduct_content.php'); 
        } elseif ($current_page == 'settings.php') {
            include('settings_content.php'); 
        } elseif ($current_page == 'profile.php') {
            include('profile_content.php');
        }
        ?>
    </div>
</div>
