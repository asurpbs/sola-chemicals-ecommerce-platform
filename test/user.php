<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/classes/item.php";
$arr = item::getAllItems();
echo $arr[3]->getImage();
?>