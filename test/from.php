<?php
include '../classes/company.php';
$publicContact = new Company();
echo $publicContact->getEmail();
?>