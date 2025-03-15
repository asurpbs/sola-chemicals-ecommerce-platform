<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT']."/context/connect.php";
require_once $_SERVER['DOCUMENT_ROOT']."/classes/user.php";

// Check if user is logged in using cookies (to match home-header.php)
if (!isset($_COOKIE['user_id'])) {
    header('Location: /pages/signin.php');
    exit();
}

// Get user data
$user = new User($_COOKIE['user_id']);

// Fetch cities for dropdown
$stmt = $conn->prepare("SELECT id, name_en FROM city ORDER BY name_en");
$stmt->execute();
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_personal'])) {
        $user->updateFirstName($_POST['first_name']);
        $user->updateLastName($_POST['last_name']);
        $user->updateEmail($_POST['email']);
        $user->updateBirthDate($_POST['birth_date']);
        if (isset($_POST['gender'])) {
            $user->updateGender($_POST['gender']);
        }
        if (!empty($_FILES['image']['name'])) {
            $user->updateImage();
        }
    } elseif (isset($_POST['update_contact'])) {
        $user->updateAddress1($_POST['address1']);
        $user->updateAddress2($_POST['address2']);
        $user->updatePostalCode($_POST['postal_code']);
        $user->updateCityId($_POST['city_id']);
        $user->updateTelephone1($_POST['telephone1']);
        $user->updateTelephone2($_POST['telephone2']);
    } elseif (isset($_POST['update_password'])) {
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            $user->updatePassword($_POST['new_password']);
        }
    }
    
    // Refresh user data
    $user = new User($_COOKIE['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Settings - Sola Chemicals</title>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/metadata.html'; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .settings-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .settings-nav {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
        }

        .settings-nav button {
            padding: 0.5rem 1rem;
            border: none;
            background: none;
            color: #666;
            cursor: pointer;
            font-size: 1rem;
            position: relative;
        }

        .settings-nav button.active {
            color: #007bff;
            font-weight: 500;
        }

        .settings-nav button.active::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 0;
            width: 100%;
            height: 2px;
            background: #007bff;
        }

        .settings-section {
            display: none;
        }

        .settings-section.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        .gender-options {
            display: flex;
            gap: 1rem;
        }

        .gender-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .gender-option input[type="radio"] {
            width: auto;
        }

        .btn-save {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.2s;
        }

        .btn-save:hover {
            background: #0056b3;
        }

        .row {
            display: flex;
            gap: 1rem;
        }

        .col {
            flex: 1;
        }
    </style>
</head>
<body>
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/home-header.php'; ?>

    <div class="settings-container">
        <h1>Account Settings</h1>
        
        <div class="settings-nav">
            <button class="active" onclick="showSection('personal')">Personal Data</button>
            <button onclick="showSection('contact')">Contact Information</button>
            <button onclick="showSection('security')">Security</button>
        </div>

        <!-- Personal Data Section -->
        <div id="personal" class="settings-section active">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <img src="<?php echo $user->getImage(); ?>" alt="Profile" class="profile-image">
                    <input type="file" name="image" accept="image/*">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user->getFirstName()); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user->getLastName()); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required>
                </div>

                <div class="form-group">
                    <label for="birth_date">Date of Birth</label>
                    <input type="date" id="birth_date" name="birth_date" value="<?php echo $user->getBirthDate(); ?>" required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div class="gender-options">
                        <label class="gender-option">
                            <input type="radio" name="gender" value="m" <?php echo $user->getGender() === 'm' ? 'checked' : ''; ?>>
                            Male
                        </label>
                        <label class="gender-option">
                            <input type="radio" name="gender" value="f" <?php echo $user->getGender() === 'f' ? 'checked' : ''; ?>>
                            Female
                        </label>
                        <label class="gender-option">
                            <input type="radio" name="gender" value="o" <?php echo $user->getGender() === 'o' ? 'checked' : ''; ?>>
                            Other
                        </label>
                    </div>
                </div>

                <button type="submit" name="update_personal" class="btn-save">Save Changes</button>
            </form>
        </div>

        <!-- Contact Information Section -->
        <div id="contact" class="settings-section">
            <form method="POST">
                <div class="form-group">
                    <label for="address1">Address Line 1</label>
                    <input type="text" id="address1" name="address1" value="<?php echo htmlspecialchars($user->getAddress1()); ?>" required>
                </div>

                <div class="form-group">
                    <label for="address2">Address Line 2</label>
                    <input type="text" id="address2" name="address2" value="<?php echo htmlspecialchars($user->getAddress2()); ?>">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select id="city_id" name="city_id" required>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo $city['id']; ?>" <?php echo $user->getCity() === $city['name_en'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($city['name_en']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($user->getPostalCode()); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="telephone1">Primary Phone</label>
                            <input type="tel" id="telephone1" name="telephone1" value="<?php echo htmlspecialchars($user->getTelephone1()); ?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="telephone2">Secondary Phone</label>
                            <input type="tel" id="telephone2" name="telephone2" value="<?php echo htmlspecialchars($user->getTelephone2()); ?>">
                        </div>
                    </div>
                </div>

                <button type="submit" name="update_contact" class="btn-save">Save Changes</button>
            </form>
        </div>

        <!-- Security Section -->
        <div id="security" class="settings-section">
            <form method="POST">
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <button type="submit" name="update_password" class="btn-save">Update Password</button>
            </form>
        </div>
    </div>

    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/components/home-footer.php'; ?>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.settings-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Remove active class from all nav buttons
            document.querySelectorAll('.settings-nav button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }

        // Initialize Select2 for city dropdown
        $(document).ready(function() {
            $('#city_id').select2();
        });
    </script>
</body>
</html> 