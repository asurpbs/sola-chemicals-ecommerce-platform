<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/classes/user.php";
$user = new User(9);
echo $user->getTelephone1();
?>