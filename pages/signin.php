<?php
$error_state = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../utils/verifyCrendentials.php';
    $error_state = verifyCredentials('user');
}
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <title>Sign in</title>

    <!-- metadata -->
    <?php require_once '../components/metadata.html'; ?>
    <link rel="stylesheet" href="signin.css">
    <style>
      .btn-login i {
        margin-right: 8px;
      }
    </style>
  </head>
<body>
<?php if ($error_state == 1): ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="?invalid" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Invalid password or email. Please try again.
            </div>
        <?php endif; ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <div class="text-center mb-4">
              <img src="../public/Main-Logo.svg" alt="Main Logo" class="img-fluid" style="max-width: 150px;">
            </div>
            <form action="" method="post" enctype="multipart/form-data" >
              <div class="form-floating mb-3">
                <label for="floatingInput">Email address</label>
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                
              </div>
              <div class="form-floating mb-3">
                <label for="floatingPassword">Password</label>
                <input name="pass" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                
              </div>
              <div class="text-right">
                <a href="#" class="small">Forgot password?</a>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Remember password
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submitlogin">Sign in</button>
              </div>
              <hr class="my-4">
              <div class="d-grid mb-2">
                <button class="btn btn-danger btn-login text-uppercase fw-bold d-flex align-items-center justify-content-center w-100" type="button1">
                  <i class="fab fa-google"></i> <span>Sign in with Google</span>
                </button>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold d-flex align-items-center justify-content-center w-100" type="button2">
                  <i class="fab fa-facebook-f"></i> <span>Sign in with Facebook</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
</body>
</html>
