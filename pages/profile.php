<?php
require_once('../context/connect.php');

if (!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_COOKIE['user_id'];
$alerts = [];

// Get user data
try {
    $stmt = $conn->prepare("SELECT u.*, ua.address1, ua.address2, ua.postal_code, c.name_en as city, ut.telephone1, ut.telephone2, u.image 
                           FROM user u 
                           LEFT JOIN user_address ua ON u.id = ua.user_id 
                           LEFT JOIN city c ON ua.city_id = c.id
                           LEFT JOIN user_telephone ut ON u.id = ut.user_id
                           WHERE u.id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $alerts[] = ["type" => "danger", "message" => "Error fetching user data: " . $e->getMessage()];
}

// Handle profile update
if (isset($_POST['update_profile'])) {
    try {
        $stmt = $conn->prepare("UPDATE user SET first_name = ?, last_name = ?, email = ?, date_modified = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'], $userId]);

        $stmt = $conn->prepare("UPDATE user_address SET address1 = ?, address2 = ?, postal_code = ? WHERE user_id = ?");
        $stmt->execute([$_POST['address1'], $_POST['address2'], $_POST['postal_code'], $userId]);

        $stmt = $conn->prepare("UPDATE user_telephone SET telephone1 = ?, telephone2 = ? WHERE user_id = ?");
        $stmt->execute([$_POST['telephone1'], $_POST['telephone2'], $userId]);

        $alerts[] = ["type" => "success", "message" => "Profile updated successfully!"];
        
        // Refresh user data
        header("Refresh:0");
    } catch(PDOException $e) {
        $alerts[] = ["type" => "danger", "message" => "Error updating profile: " . $e->getMessage()];
    }
}

// Handle password change
if (isset($_POST['change_password'])) {
    try {
        // Verify current password
        $stmt = $conn->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->execute([$userId]);
        $currentHash = $stmt->fetchColumn();

        if (password_verify($_POST['current_password'], $currentHash)) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $newHash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                $stmt = $conn->prepare("UPDATE user SET password = ? WHERE id = ?");
                $stmt->execute([$newHash, $userId]);
                $alerts[] = ["type" => "success", "message" => "Password changed successfully!"];
            } else {
                $alerts[] = ["type" => "danger", "message" => "New passwords do not match!"];
            }
        } else {
            $alerts[] = ["type" => "danger", "message" => "Current password is incorrect!"];
        }
    } catch(PDOException $e) {
        $alerts[] = ["type" => "danger", "message" => "Error changing password: " . $e->getMessage()];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/metadata.html'; ?>
    <title>User Profile</title>
    <link href="../assets/css/profile.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Display alerts -->
        <?php foreach($alerts as $alert): ?>
            <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $alert['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach; ?>

        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>

        <!-- Profile Header -->
        <div class="profile-header text-center mb-4">
            <img src="../uploads/user/<?php echo $user['image'] ? $user['image'] : 'null.png'; ?>" alt="Profile Image" class="profile-image">
            <h1 class="mt-3"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h1>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                    type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="edit-profile-tab" data-bs-toggle="tab" data-bs-target="#edit-profile"
                    type="button" role="tab" aria-controls="edit-profile" aria-selected="false">Edit Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password"
                    type="button" role="tab" aria-controls="change-password" aria-selected="false">Change
                    Password</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3" id="myTabContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <h2>Overview</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile Information</h5>
                        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address1'] . ', ' . $user['address2']); ?></p>
                        <p><strong>City:</strong> <?php echo htmlspecialchars($user['city']); ?></p>
                        <p><strong>Postal Code:</strong> <?php echo htmlspecialchars($user['postal_code']); ?></p>
                        <p><strong>Phone 1:</strong> <?php echo htmlspecialchars($user['telephone1']); ?></p>
                        <p><strong>Phone 2:</strong> <?php echo htmlspecialchars($user['telephone2']); ?></p>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Tab -->
            <div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                <h2>Edit Profile</h2>

                <!-- Profile Image Section -->
                <div class="profile-image-section text-center mb-4">
                    <img src="<?php echo '../uploads/user/' . ($user['image'] ? $user['image'] : 'null.png'); ?>" alt="Profile Image" class="profile-image" id="profileImage">
                    <div class="mt-2">
                        <input type="file" id="uploadImage" accept="image/*" style="display: none;">
                        <button type="button" class="btn btn-secondary btn-sm" id="uploadButton">Upload Image</button>
                        <button type="button" class="btn btn-danger btn-sm" id="deleteButton">Delete Image</button>
                    </div>
                </div>

                <!-- Edit Profile Form -->
                <form id="editProfileForm" method="POST" action="">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone1" class="form-label">Primary Phone</label>
                        <input type="tel" class="form-control" id="telephone1" name="telephone1" value="<?php echo htmlspecialchars($user['telephone1']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone2" class="form-label">Secondary Phone (Optional)</label>
                        <input type="tel" class="form-control" id="telephone2" name="telephone2" value="<?php echo htmlspecialchars($user['telephone2']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" value="<?php echo htmlspecialchars($user['address1']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" id="address2" name="address2" value="<?php echo htmlspecialchars($user['address2']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required>
                    </div>
                    <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <!-- Change Password Tab -->
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                <h2>Change Password</h2>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="reenterPassword" class="form-label">Re-enter New Password</label>
                        <input type="password" class="form-control" id="reenterPassword" name="confirm_password" required>
                    </div>
                    <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/profile.js"></script>
</body>

</html>