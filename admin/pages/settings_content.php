<?php
session_start();
include('../context/connect.php');

// Handle Update Admin Details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_email'])) {
        // Update Admin Email
        $admin_email = $_POST['admin_email'];
        $stmt = $conn->prepare("UPDATE admin SET email = ? WHERE id = 1"); // Assuming admin ID is 1
        $stmt->execute([$admin_email]);
        $message = "Email updated successfully.";
    } elseif (isset($_POST['update_password'])) {
        // Update Admin Password
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = 1"); // Assuming admin ID is 1
        $stmt->execute([$new_password]);
        $message = "Password updated successfully.";
    } elseif (isset($_POST['update_details'])) {
        // Update Admin Name, Gender, Phone, Role, and Image

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $tele_number = $_POST['tele_number'];
        $role = $_POST['role'];

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = 'uploads/' . $image_name;
            move_uploaded_file($image_tmp, $image_path);
        } else {
            $image_path = $_POST['current_image']; // If no new image, use the current one
        }

        $stmt = $conn->prepare("UPDATE admin SET first_name = ?, last_name = ?, gender = ?, tele_number = ?, role = ?, image = ?, date_modified = NOW() WHERE id = 1");
        $stmt->execute([$first_name, $last_name, $gender, $tele_number, $role, $image_path]);
        $message = "Admin details updated successfully.";
    }
}

// Fetch the current admin settings (email, password, etc.)
$admin = $conn->query("SELECT * FROM admin WHERE id = 1")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Settings</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Admin Details Update Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Update Admin Details</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="settings.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($admin['first_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($admin['last_name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="Male" <?= $admin['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $admin['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= $admin['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tele_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="tele_number" name="tele_number" value="<?= htmlspecialchars($admin['tele_number']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="admin" <?= $admin['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="superadmin" <?= $admin['role'] == 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                    <br>
                    <img src="<?= htmlspecialchars($admin['image']) ?>" alt="Admin Image" style="max-width: 100px; margin-top: 10px;">
                    <input type="hidden" name="current_image" value="<?= htmlspecialchars($admin['image']) ?>"> <!-- Preserve current image path -->
                </div>
                <button type="submit" name="update_details" class="btn btn-primary">Update Details</button>
            </form>
        </div>
    </div>

    <!-- Admin Email Update Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Update Admin Email</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="settings.php">
                <div class="mb-3">
                    <label for="admin_email" class="form-label">Admin Email</label>
                    <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?= htmlspecialchars($admin['email']) ?>" required>
                </div>
                <button type="submit" name="update_email" class="btn btn-primary">Update Email</button>
            </form>
        </div>
    </div>

    <!-- Admin Password Update Form -->
    <div class="card">
        <div class="card-header">
            <h5>Update Admin Password</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="settings.php">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
