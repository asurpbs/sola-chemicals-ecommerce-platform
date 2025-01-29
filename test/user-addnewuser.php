<?php
require_once "../classes/user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User(
        null,
        $_POST['first_name'],
        $_POST['last_name'],
        $_FILES['image']['name'],
        $_POST['gender'],
        $_POST['birth_date'],
        $_POST['password'],
        $_POST['email'],
        $_POST['address1'],
        $_POST['address2'],
        $_POST['postal_code'],
        $_POST['city_id'],
        $_POST['telephone1'],
        $_POST['telephone2']
    )
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test User</title>
</head>
<body>
    <h1>Test User</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $_POST['user_id'] ?? ''; ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $_POST['first_name'] ?? ''; ?>"><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $_POST['last_name'] ?? ''; ?>"><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br>

        <label for="gender">Gender:</label>
        <input type="number" name="gender" id="gender" value="<?php echo $_POST['gender'] ?? ''; ?>"><br>

        <label for="birth_date">Birth Date:</label>
        <input type="date" name="birth_date" id="birth_date" value="<?php echo $_POST['birth_date'] ?? ''; ?>"><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $_POST['email'] ?? ''; ?>"><br>

        <label for="address1">Address Line 1:</label>
        <input type="text" name="address1" id="address1" value="<?php echo $_POST['address1'] ?? ''; ?>"><br>

        <label for="address2">Address Line 2:</label>
        <input type="text" name="address2" id="address2" value="<?php echo $_POST['address2'] ?? ''; ?>"><br>

        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" id="postal_code" value="<?php echo $_POST['postal_code'] ?? ''; ?>"><br>

        <label for="city_id">City ID:</label>
        <input type="number" name="city_id" id="city_id" value="<?php echo $_POST['city_id'] ?? ''; ?>"><br>

        <label for="telephone1">Telephone 1:</label>
        <input type="text" name="telephone1" id="telephone1" value="<?php echo $_POST['telephone1'] ?? ''; ?>"><br>

        <label for="telephone2">Telephone 2:</label>
        <input type="text" name="telephone2" id="telephone2" value="<?php echo $_POST['telephone2'] ?? ''; ?>"><br>

        <button type="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</body>
</html>
