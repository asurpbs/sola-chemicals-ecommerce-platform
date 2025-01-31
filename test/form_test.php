<?php
include_once $_SERVER['DOCUMENT_ROOT']."/utils/verifyCredentials.php";
$error_state = verifyCredentials('user');
if ($error_state === 1) {
    echo "Invalid email or password";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Test Form</title>
</head>
<body>
    <h2>Login Test Form</h2>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required>
        <br>
        <input type="submit" name="submitlogin" value="Login">
    </form>
</body>
</html>
