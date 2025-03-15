<?php
require_once "../context/connect.php";
require_once "../classes/user.php";

// Fetch city data
$stmt = $conn->prepare("SELECT id, name_en FROM city");
$stmt->execute();
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User(
        null,
        $_POST['first_name'] ?? '',
        $_POST['last_name'] ?? '',
        $_FILES['image']['name'] ?? '',
        $_POST['gender'] ?? '',
        $_POST['birth_date'] ?? '',
        $_POST['password'] ?? '',
        $_POST['email'] ?? '',
        $_POST['address1'] ?? '',
        $_POST['address2'] ?? '',
        $_POST['postal_code'] ?? '',
        $_POST['city_id'] ?? '',
        $_POST['telephone1'] ?? '',
        $_POST['telephone2'] ?? ''
    );
    echo "<script>
        alert('User created successfully!');
        document.getElementById('signupForm').reset();
        window.location.href = '/index.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign in to Sola Chemicals</title>
    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <!-- Include select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/signup.css">
  </head>
<body>
    <div class="container">
        <div class="signup-card">
            <div class="logo">
                <img src="/public/apple-touch-icon.png" alt="Sola Chemicals Logo">
                <h2>Sign up to Sola Chemicals</h2>
            </div>
            <form id="signupForm" method="POST" enctype="multipart/form-data">
                <!-- Personal Information -->
                <div class="form-section">
                    <h4 class="mb-3">Personal Information</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" id="firstName" value="<?php echo $_POST['first_name'] ?? ''; ?>" required>
                            <span class="error-message" id="firstNameError"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" id="lastName" value="<?php echo $_POST['last_name'] ?? ''; ?>" required>
                            <span class="error-message" id="lastNameError"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                                <option value="o">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="birthDate" class="form-label">Birth Date</label>
                            <input name="birth_date" type="date" class="form-control" id="birthDate" value="<?php echo $_POST['birth_date'] ?? ''; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Picture</label>
                        <input name="image" type="file" class="form-control" id="image" accept="image/*" required>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="form-section">
                    <h4 class="mb-3">Account Information</h4>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input name="email" type="email" class="form-control" id="email" value="<?php echo $_POST['email'] ?? ''; ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <h4 class="mb-3">Contact Information</h4>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Address Line 1</label>
                        <input name="address1" type="text" class="form-control" id="address1" value="<?php echo $_POST['address1'] ?? ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Address Line 2</label>
                        <input name="address2" type="text" class="form-control" id="address2" value="<?php echo $_POST['address2'] ?? ''; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input name="postal_code" type="text" class="form-control" id="postalCode" value="<?php echo $_POST['postal_code'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <select class="form-select" id="city" name="city_id" required>
                                <option value="">Select City</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo $city['id']; ?>"><?php echo $city['name_en']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telephoneNum1" class="form-label">Primary Phone</label>
                            <input name="telephone1" type="tel" class="form-control" id="telephoneNum1" value="<?php echo $_POST['telephone1'] ?? ''; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telephoneNum2" class="form-label">Secondary Phone (Optional)</label>
                            <input name="telephone2" type="tel" class="form-control" id="telephoneNum2" value="<?php echo $_POST['telephone2'] ?? ''; ?>">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Create Account</button>
                <p class="text-center">Already have an account? <a href="/pages/signin.php">Sign in</a></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#city').select2({
            placeholder: 'Select a city',
            allowClear: true
        });
    });
    </script>
</body>
</html>