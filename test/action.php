<?php
include $_SERVER['DOCUMENT_ROOT']."/classes/admin.php";
require_once "../utils/image.php";
// get data from database of user whose id is 1
//$newUser = new Admin(9);
//echo $newUser->getRole()."<br>";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['name']) && !empty($_POST['name']) && isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $newuser1 = new Admin(null, $_POST['name'], "Doe", $_FILES['image'], 1, "John@gmail.com", "Saegis@135", "0771234567", "Admin");

        // Redirect to the same page to prevent form resubmission
        //header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Name and image are required.<br>";
    }
}
?>