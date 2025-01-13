<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include '/components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id = $_COOKIE['user_id'];
        header('Location:/admin/pages/index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signin - Admin | Sola Chemicals</title>
        <?php include '../data/meta-admin.php'; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
       <link rel="stylesheet" href="/assets/css/login.css">
    </head>
    <body>
        <div class="container">
            <div class="header">
                <a href=""><img src="/public/apple-touch-icon.png" alt="ExamGIS_logo" width="70px" height="70px"><span></span></a>
                <h1>Sign in to Sola Chemicals</h1>
            </div>
            <form action="./components/login-post.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="email" name="email" id="email" required class="inputField" autocomplete="off">
                    <input type="password" name="pass" id="pass" required class="inputField" autocomplete="off">
                    <button type="submit" name="submitlogin" class="btn">Sign In</button>
                </div>
            </form>
        </div>
        <footer class="footer-del">
            <span class="author">
                © 2025 Sola Chemical Company. All rights reserved.
            </span>
        <footer>
        <?php include "../data/bootstrap.php" ?>
    </body>
</html>