<?php
    include $_SERVER['DOCUMENT_ROOT']."/classes/user.php";
    // get data from database of user whose id is 1
    $newUser = new User(7);

    echo $newUser->deleteUser();

?>