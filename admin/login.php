<?php
$error_state = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../utils/verifyCrendentials.php';
    $error_state = verifyCredentials('admin');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signin - Admin | Sola Chemicals</title>
        
        <!-- metadata -->
        <?php include '../components/metadata-admin.html'; ?>

        <link rel="stylesheet" href="/admin/assets/css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <?php if ($error_state == 1): ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="?invalid" class="close" data-bs-dismiss="alert" aria-label="close">&times;</a>
                Invalid password or email. Please try again.
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="header">
                <a href=""><img src="../public/apple-touch-icon.png" alt="sola chemicals logo" width="70px" height="70px"><span></span></a>
                <h1>Sign in to Sola Chemicals</h1>
            </div>
            <form action="" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <input type="email" name="email" id="email" required class="inputField" autocomplete="off">
                    <label for="email">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" name="pass" id="password" required class="inputField" autocomplete="off">
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="submitButton" name="submitlogin">Log in</button>
            </form>
        </div>
        <footer class="footer-del">
                © 2025 Hash Coders. All rights reserved.
            </span>
        </footer>
        <script src="/assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
        <script src="./assets/js/script.js"></script>
    </body>
</html>