<?php
include "../classes/user.php";

// Create a new user
$newUser = new User(
    null, // user_id is null for creating a new user
    "John", // first_name
    "Doe", // last_name
    "john_doe.jpg", // image
    "1", // gender
    "1990-01-01", // birth_date
    "password123", // password
    "john.doe@example.com", // email
    "123 Main St", // address1
    "Apt 4B", // address2
    "12345", // postal_code
    1, // city_id
    "1234567890", // telephone1
    "0987654321" // telephone2
);

$newUser1 = new User(1);

echo "Created suer's first name: " . $newUser->getFirstName();
echo "Existing user's name: " . $newUser1->getFirstName();

$newUser->deleteUser();
?>