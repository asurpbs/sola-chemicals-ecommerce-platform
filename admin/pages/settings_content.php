<?php
session_start();
include('../context/connect.php');

// Handle Update Admin Settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_email'])) {
        // Update Admin Email
        $admin_email = $_POST['admin_email'];
        $stmt = $conn->prepare("UPDATE admin SET email = ? WHERE id = 1");
        $stmt->execute([$admin_email]);
        $message = "Email updated successfully.";
    } elseif (isset($_POST['update_password'])) {
        // Update Admin Password
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = 1");
        $stmt->execute([$new_password]);
        $message = "Password updated successfully.";
    }
}

// Fetch admin email for display
$admin = $conn->query("SELECT email FROM admin WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Account Settings</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Email Update Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Update Email Address</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="admin_email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="admin_email" name="admin_email" 
                           value="<?= htmlspecialchars($admin['email']) ?>" required>
                </div>
                <button type="submit" name="update_email" class="btn btn-primary">Update Email</button>
            </form>
        </div>
    </div>

    <!-- Password Update Form -->
    <div class="card">
        <div class="card-header">
            <h5>Change Password</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" name="update_password" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>