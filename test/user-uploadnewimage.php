<?php
require_once "../classes/user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User(1);
    $user->updateImage();
    echo "Image updated successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Upload User Image</title>
</head>
<body>
    <h1>Test Upload User Image</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
