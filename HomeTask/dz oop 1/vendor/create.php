<?php
require_once "../config/connect.php";

$name = $_POST['name'];
$price = $_POST['price'];

mysqli_query($connect, "INSERT INTO `gadgets` (`id`, `name`, `price`) VALUES (NULL, '$name', '$price')");
header('Location: /GitHub/lessons/dz oop 1/');