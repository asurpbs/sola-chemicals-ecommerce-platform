<?php
session_start();
require_once('../context/connect.php');

$successMessage = "";
$errorMessage = "";

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    try {
        $query = "UPDATE admin SET first_name = ?, last_name = ?, role = ?, email = ?, tele_number = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['role'],
            $_POST['email'],
            $_POST['phone'],
            $_SESSION['user_id'] ?? 0  // Remove session-based user ID dependency
        ]);
        
        $successMessage = "Profile updated successfully!";
    } catch (PDOException $e) {
        $errorMessage = "Error updating profile: " . $e->getMessage();
    }
}

// Handle password change removed for security reasons

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload_image'])) {
    try {
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $file_ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($file_ext, $allowed)) {
                $new_filename = substr(uniqid(), 0, 13) . '.' . $file_ext;
                $upload_path = '../uploads/profile_images/' . $new_filename;
                
                if (!file_exists('../uploads/profile_images')) {
                    mkdir('../uploads/profile_images', 0777, true);
                }
                
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                    $successMessage = "Image uploaded successfully!";
                }
            }
        }
    } catch (Exception $e) {
        $errorMessage = "Error updating image: " . $e->getMessage();
    }
}

// Get user data
try {
    $stmt = $conn->query("SELECT * FROM admin LIMIT 1");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $profile_image = '../uploads/profile_images/null.png';
    if ($user['image'] && $user['image'] !== 'null.png') {
        $image_path = '../uploads/profile_images/' . $user['image'];
        if (file_exists($image_path)) {
            $profile_image = $image_path;
        }
    }
} catch (PDOException $e) {
    die("Error fetching user data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-image { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; }
        .nav-tabs { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="<?= $profile_image ?>" alt="Profile" class="profile-image">
            <h1 class="mt-3"><?= htmlspecialchars($user['first_name'].' '.$user['last_name']) ?></h1>
            <p class="text-muted"><?= htmlspecialchars($user['role']) ?></p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" 
                            value="<?= htmlspecialchars($user['first_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" 
                            value="<?= htmlspecialchars($user['last_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label>Profile Image</label>
                        <input type="file" name="profile_image" class="form-control">
                    </div>
                    <button type="submit" name="upload_image" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>