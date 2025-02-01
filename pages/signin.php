<?php
$error_state = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../utils/verifyCrendentials.php';
    $error_state = verifyCredentials('user');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign in to Sola Chemicals</title>
    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <link rel="stylesheet" href="/assets/css/signin.css">
  </head>
<body>
    <?php if ($error_state == 1): ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="?invalid" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            Invalid password or email. Please try again.
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="text-center">
            <img src="/public/apple-touch-icon.png" alt="Sola Chemicals" class="logo">
            <h2 class="mb-4">Sign in to Sola Chemicals</h2>
        </div>
        <form  action="" method="post" enctype="multipart/form-data" id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="pass" type="password" class="form-control" id="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submitlogin">Login</button>
            <div class="forgot-password mt-3">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="signup mt-3">
                Don't have an account? <a href="#">Sign up</a>
            </div>
        </form>
    </div>

    <script src="/assets/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Please fill in all fields.');
                event.preventDefault();
            }
        });
    </script>

</body>
</html>