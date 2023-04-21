<?php
require_once "../config/connect.php";

$name = $_POST['name'];
$text = $_POST['text'];
$price = $_POST['price'];

mysqli_query($connect, "INSERT INTO `products` (`id`, `product_name`, `product_text`, `product_price`) VALUES (NULL, '$name', '$text', '$price')");
header('Location: /GitHub/lessons/');