<?php
$host="localhost";
$customer="root";
$password="";
$database="web-home-automation";

$connection = mysqli_connect($host, $customer,$password,$database);
mysqli_set_charset($connection,"UTF8");
?>