<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/classes/user.php";
    // get data from database of user whose id is 1
    $user = new User(null, 'Kasun', 'Disanayake', '', 'm', '2020-10-01', 'Hello', 'asur@gmail.com', '123', 'Addr 1', '12121', '22', '0772323123', null);
    echo $user->getFirstName();

?>