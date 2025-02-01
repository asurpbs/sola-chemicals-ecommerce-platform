<?php
    require_once '../context/connect.php';


// Step 2: Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Encrypt the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle image upload
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        $imageName = $_FILES['imageUpload']['name'];
        $imageTmpName = $_FILES['imageUpload']['tmp_name'];
        $uploadDir = "uploads/"; // Directory to save uploaded images
        $uploadFile = $uploadDir . basename($imageName);

        // Create uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file to the uploads directory
        if (move_uploaded_file($imageTmpName, $uploadFile)) {
            $imagePath = $uploadFile; // Save the file path for the database
        } else {
            echo "Failed to upload image.";
            exit;
        }
    } else {
        $imagePath = null; // No image uploaded
    }

    // Step 3: Insert Data into Database
    $sql = "INSERT INTO user (name, email, password, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql); // Prepare the SQL statement
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $imagePath); // Bind parameters

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "Sign-up successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta tags for character encoding and responsive design -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Sola Chemicals</title>
  
  <!-- Bootstrap CSS for styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Link to external CSS file -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <!-- Main container to center the card vertically and horizontally -->
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <!-- Card for the sign-up form -->
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
      
      <!-- Logo and title -->
      <div class="text-center">
        <!-- Placeholder for logo image -->
        <img src="../Sign In/images/Main-Logo.svg" alt="Sola Chemicals Logo" class="img-fluid mb-3" style="max-height: 80px;">
        <h3 class="mb-4">Sign up to Sola Chemicals</h3>
      </div>

      <!-- Sign-up form -->
      <form id="signupForm">
        <!-- Input field for name -->
        <div class="mb-3">
          <label for="name" class="form-label">Enter your name</label>
          <input type="text" id="name" class="form-control" placeholder="Your Name" required>
        </div>

        <!-- Input field for email -->
        <div class="mb-3">
          <label for="email" class="form-label">Enter your email</label>
          <input type="email" id="email" class="form-control" placeholder="Your Email" required>
        </div>

        <!-- Input field for password -->
        <div class="mb-3">
          <label for="password" class="form-label">Enter a Password</label>
          <input type="password" id="password" class="form-control" placeholder="Password" required>
        </div>

        <!-- Input field to confirm password -->
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirm your password</label>
          <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>
        </div>

        <!-- File input for uploading an image -->
        <div class="mb-3">
          <label for="imageUpload" class="form-label">Choose an image</label>
          <input type="file" id="imageUpload" class="form-control" accept="image/*">
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary w-100">Sign up</button>
      </form>

      <!-- Link to sign-in page -->
      <div class="text-center mt-3">
        <p>If you already have an account, <a href="signin.html">Sign in</a></p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript for interactivity -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Link to external JavaScript file -->
  <script src="script.js"></script>
</body>
</html>
