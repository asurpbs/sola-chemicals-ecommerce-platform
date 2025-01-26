<?php
    include $_SERVER['DOCUMENT_ROOT']."/classes/admin.php";
    $user = new Admin(1);
    $user->deleteAdmin();
    //echo $user->getImage();
    //fileDelete($user->getImage());
?>