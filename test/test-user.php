<?php
include "../classes/user.php";

// Create a new user
$newUser = new User(
    null,
    "John",
    "Doe",
    "john_doe.jpg",
    "1",
    "1990-01-01",
    "password123",
    "john.doe@example.com",
    "123 Main St",
    "Apt 4B",
    "12345",
    1,
    "1234567890",
    "0987654321"
);

$newUser1 = new User(1);

echo "Created suer's first name: " . $newUser->getFirstName();
echo "Existing user's name: " . $newUser1->getFirstName();

$newUser->deleteUser();
?>