<?php
require_once "../classes/user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User(
        null,
        $_POST['first_name'],
        $_POST['last_name'],
        $_FILES['image']['name'],
        $_POST['gender'],
        $_POST['birth_date'],
        $_POST['password'],
        $_POST['email'],
        $_POST['address1'],
        $_POST['address2'],
        $_POST['postal_code'],
        $_POST['city_id'],
        $_POST['telephone1'],
        $_POST['telephone2']
    );
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign in to Sola Chemicals</title>
    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <link rel="stylesheet" href="/assets/css/signup.css">
  </head>
<body>
<div class="container">
        <div class="logo">
            <img src="/public/apple-touch-icon.png" alt="Sola Chemicals Logo">
            <h2 class="mb-4">Sign up to Sola Chemicals</h2>
        </div>
        <form id="signupForm">
            <!-- First Name -->
            <div class="mb-3">
                <label for="firstName" class="form-label">Enter First Name</label>
                <input name="first_name" type="text" class="form-control" id="firstName" placeholder="First Name" value="<?php echo $_POST['first_name'] ?? ''; ?>" required>
                <span class="error-message" id="firstNameError"></span>
            </div>

            <!-- Last Name -->
            <div class="mb-3">
                <label for="lastName" class="form-label">Enter Last Name</label>
                <input name="last_name" type="text" class="form-control" id="lastName" placeholder="Last Name" value="<?php echo $_POST['last_name'] ?? ''; ?> required>
                <span class="error-message" id="lastNameError"></span>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label for="gender" class="form-label">Select Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="<?php echo $_POST['gender'] ?? ''; ?>Select Gender</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                    <option value="o">Other</option>
                </select>
                <span class="error-message" id="genderError"></span>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" accept="image/*" required>
                <span class="error-message" name="image" id="imageError"></span>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Enter Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $_POST['email'] ?? ''; ?> required>
                <span class="error-message" id="emailError"></span>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Enter Password</label>
                <input  name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                <span class="error-message" id="passwordError"></span>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                <span class="error-message" id="confirmPasswordError"></span>
            </div>

            <!-- Address Line 1 -->
            <div class="mb-3">
                <label for="address1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" id="address1" placeholder="Address Line 1" required>
                <span class="error-message" id="address1Error"></span>
            </div>

            <!-- Address Line 2 -->
            <div class="mb-3">
                <label for="address2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" id="address2" placeholder="Address Line 2">
            </div>

            <!-- Postal Code -->
            <div class="mb-3">
                <label for="postalCode" class="form-label">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" placeholder="Postal Code" required>
                <span class="error-message" id="postalCodeError"></span>
            </div>

            <!-- City -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" placeholder="City" required>
                <span class="error-message" id="cityError"></span>
            </div>

            <!-- Telephone Number 1 -->
            <div class="mb-3">
                <label for="telephoneNum1" class="form-label">Telephone Number 1</label>
                <input type="tel" class="form-control" id="telephoneNum1" placeholder="Telephone Number 1" required>
                <span class="error-message" id="telephoneNum1Error"></span>
            </div>

            <!-- Telephone Number 2 -->
            <div class="mb-3">
                <label for="telephoneNum2" class="form-label">Telephone Number 2</label>
                <input type="tel" class="form-control" id="telephoneNum2" placeholder="Telephone Number 2">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>

        <!-- Sign In Link -->
        <p class="text-center mt-3">If you already have an account, <a href="/pages/signin.php">Sign in</a></p>
    </div>

    <script src="/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>">
    <script src="/assets/js/signup.js"></script>
</body>
</html>