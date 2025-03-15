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
        <div class="alert-wrapper">
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                Invalid password or email. Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="text-center mb-4">
            <img src="/public/apple-touch-icon.png" alt="Sola Chemicals" class="logo">
            <h2 class="mb-3 fw-bold">Welcome Back</h2>
            <p class="text-muted">Sign in to continue to Sola Chemicals</p>
        </div>
        <form action="" method="post" enctype="multipart/form-data" id="loginForm" autocomplete="off">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" 
                    placeholder="name@example.com" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input name="pass" type="password" class="form-control" id="password" 
                    placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3 shadow-sm" name="submitlogin">
                Sign In
            </button>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label text-muted" for="rememberMe">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-primary text-decoration-none">Forgot Password?</a>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted">
                Don't have an account? <a href="/pages/signup.php" class="text-primary text-decoration-none">Sign up</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
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