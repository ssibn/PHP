<?php
require_once "../config/connect.php";

$name = $_POST['name'];
$price = $_POST['price'];

mysqli_query($connect, "INSERT INTO `product` (`id`, `name`, `price`) VALUES (NULL, '$name', '$price')");
header('Location: /PHP/HomeTask/dz oop 1/');
