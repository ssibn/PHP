<?php
require_once "../config/connect.php";

$categoryName = $_POST['categoryName'];
$liname = $_POST['liname'];
$liprice = $_POST['liprice'];

mysqli_query($connect, "INSERT INTO `phones` (`id`, `categoryName`, `liname`, `liprice`) VALUES (NULL, '$categoryName', '$liname', '$liprice')");

mysqli_query($connect, "DELETE FROM `product`");
header('Location: /PHP/HomeTask/dz oop 1/');
