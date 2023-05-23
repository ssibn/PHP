<?php
require_once "../config/connect.php";

$categories = $_POST['categories'];
$name = $_POST['name'];
$price = $_POST['price'];

$diagonal = $_POST['diagonal'];
$frequency  = $_POST['frequency'];

mysqli_query($connect, "INSERT INTO `category` (`id`, `categories`, `name`, `price`, `diagonal`, `frequency`) VALUES (NULL, '$categories', '$name', '$price', '$diagonal', '$frequency')");

header('Location: /PHP/HomeTask/dz oop 2/');