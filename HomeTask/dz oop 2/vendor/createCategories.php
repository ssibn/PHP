<?php
require_once "../config/connect.php";

$categories = $_POST['categories'];
$name = $_POST['name'];
$price = $_POST['price'];

$ram = $_POST['ram'];
$countsim = $_POST['countsim'];
$hdd = $_POST['hdd'];

$os = $_POST['os'];
$diagonal = $_POST['diagonal'];
$frequency  = $_POST['frequency'];

mysqli_query($connect, "INSERT INTO `category` (`id`, `categories`, `name`, `price`, `ram`, `countsim`, `hdd`, `os`, `diagonal`, `frequency`) VALUES (NULL, '$categories', '$name', '$price', '$ram', '$countsim', '$hdd', '$os', '$diagonal', '$frequency')");

header('Location: /PHP/HomeTask/dz oop 2/');