<?php
require_once "../config/connect.php";

$name = $_POST['name'];
$price = $_POST['price'];

$diagonal = $_POST['diagonal'];
$frequency  = $_POST['frequency'];

mysqli_query($connect, "INSERT INTO `monitors` (`id`, `categories`, `name`, `price`, `diagonal`, `frequency`) VALUES (NULL, 'Monitor', '$name', '$price', '$diagonal', '$frequency')");

header('Location: /PHP/HomeTask/dz oop 2/');