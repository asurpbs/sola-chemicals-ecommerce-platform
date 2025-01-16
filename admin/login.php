<?php

    include '../components/connect.php';

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $error_state = 0;
    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
        header('Location:./pages/dashboard.php');
        exit();
    }

    if(isset($_POST['submitlogin']) && !empty($_POST['email']) && !empty($_POST['pass'])){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass = filter_var($_POST['pass'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ? LIMIT 1");
        $select_user->execute([$email]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);
       
        if($select_user->rowCount() > 0 && password_verify($pass, $row['password'])){
            setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:../pages/dashboard.php');
            exit();
        } else {
            $error_state = 1;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signin - Admin | Sola Chemicals</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="title" content="Sola Chemical Company"/>
        <meta name="description" content="Administrator site of the Sola Chemical Company"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!--
        <meta name="robots" content="index, follow"/>
        <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
        <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1"/>
        <link rel="canonical" href="https://hashcoders.alwaysdata.net/admin/"/>
        -->
        <link rel="icon" type="image/png" href="../public/favicon-96x96.png" sizes="96x96"/>
        <link rel="icon" type="image/svg+xml" href="../public/favicon.svg"/>
        <link rel="shortcut icon" href="../public/favicon.ico"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/public/apple-touch-icon.png"/>
        <link rel="manifest" href="../public/site.webmanifest"/>
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
        <link rel="canonical" href="https://hashcoders.alwaysdata.net/admin/"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="./assets/css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <?php if ($error_state == 1): ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="?invalid" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>