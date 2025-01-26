<?php
    include $_SERVER['DOCUMENT_ROOT']."/classes/user.php";
    // get data from database of user whose id is 1
    $newUser = new User(1);

    echo $newUser->getProvince();

    /**
    if (isset($_POST['submit'])) {
        $newuser1 = new User(null, "John", "Doe", "", 1, "2001-12-12", "Saegis@135", "john@gmail.com", "123/1", "colombo", 11200, 12, "0771234567");
        echo $newuser1->getFirstName()."<br>";
        echo $newuser1->getLastName()."<br>";
        echo $newuser1->getProvince()."<br>";
        echo $newuser1->getCity()."<br>";
        echo $newuser1->getPostalCode()."<br>";
        echo $newuser1->getImage()."<br>";
    }
    */
    //delete object
    //unset($newUser);
    echo $newUser->getImage();
?>