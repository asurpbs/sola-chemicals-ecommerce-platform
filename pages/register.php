<!DOCTYPE html>
<html lang="en">
 
    <head>
       <!-- meta properties -->
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Signup to ExamGIS</title>

       <!-- Fav-icon -->
       <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-touch-icon.png">
       <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
       <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
       <link rel="manifest" href="./images/site.webmanifest">

       <!-- font awesome cdn link  -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

       <!-- custom css file link  -->
       <link rel="stylesheet" href="/assets/css/modal-login.css">

    </head>

    <body>
        <div class="container">
            <div class="header">
                <a href=""><img src="./images/favicon/apple-touch-icon.png" alt="ExamGIS_logo" width="70px" height="70px"><span></span></a>
                <h1>Sign up to ExamGIS</h1>
            </div>
            <form action="#" method="post" enctype="multipart/form-data"  autocomplete="off">
                <div class="form-group">
                    <input type="text" name="name" class="inputField" autocomplete="off" required>
                    <label for="name" class="inputfieldText">Enter your name</label>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="inputField" autocomplete="off" required>
                    <label for="email">Enter your email</label>
                </div>
                <div class="form-group">
                    <input type="password" name="pass" class="inputField" autocomplete="off" minlength="8" required>
                    <label for="password">Enter a Password</label>
                </div>
                <div class="form-group">
                    <input type="password" name="cpass" class="inputField" autocomplete="off" required>
                    <label for="password">Confirm your password</label>
                </div>
                <div class="form-group">
                    <div class="inputImage">
                        <input type="file" accept="image/*" name="image" id="imageInput" autocomplete="off" required onchange="displayImage()">
                        <label for="imageInput" class="customFileInput" id="fileLabel">Choose an image</label>
                        <img id="imagePreview" style="display: none; max-width: 100%; border-radius: 8px;" />
                    </div>
                </div>
                <button type="submit" name="submitregister" class="submitButton">Sign up</button>
            </form>
            <div class="footer">
                <a href="./login.php">If you already have an account, Sign in</a>
            </div>
        </div>
        <footer class="footer-del">
            <span class="author">
                © 2024  MTC LLC. All rights reserved.
            </span>
        <footer>
            
        <!-- custom js file link  -->
        <script src="js/script.js"></script>
    <body>
</html> 
