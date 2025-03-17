<?php
session_start();
include('../context/connect.php');

$admin_id = $_SESSION['admin_id'];

// Fetch admin details
$stmt = $conn->prepare("SELECT * FROM admin WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle Profile Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_profile'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $tele_number = $_POST['tele_number'];
        $gender = $_POST['gender'];

        // Handle Image Upload
        if (!empty($_FILES['profile_image']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
        } else {
            $target_file = $admin['image']; // Keep existing image if no new image uploaded
        }

        // Update Admin Details
        $updateStmt = $conn->prepare("UPDATE admin SET first_name = ?, last_name = ?, tele_number = ?, gender = ?, image = ? WHERE id = ?");
        $updateStmt->execute([$first_name, $last_name, $tele_number, $gender, $target_file, $admin_id]);

        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    }

    // Handle Password Change
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (password_verify($current_password, $admin['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $passStmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
                $passStmt->execute([$hashed_password, $admin_id]);

                $_SESSION['success'] = "Password changed successfully!";
            } else {
                $_SESSION['error'] = "New passwords do not match!";
            }
        } else {
            $_SESSION['error'] = "Incorrect current password!";
        }
        header("Location: profile.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Admin Profile</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <img src="<?= !empty($admin['image']) ? $admin['image'] : 'default-profile.png'; ?>" 
                     alt="Profile Picture" class="img-thumbnail" width="150">
            </div>

            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($admin['first_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($admin['last_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="Male" <?= $admin['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?= $admin['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?= $admin['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telephone Number</label>
                    <input type="text" name="tele_number" class="form-control" value="<?= htmlspecialchars($admin['tele_number']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Profile Image</label>
                    <input type="file" name="profile_image" class="form-control">
                </div>

                <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
            </form>

            <hr>

            <h4>Change Password</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <button type="submit" name="change_password" class="btn btn-warning">Change Password</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
