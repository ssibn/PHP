<?php
require_once "../config/connect.php";

$name = $_POST['name'];
$price = $_POST['price'];

$ram = $_POST['ram'];
$countsim = $_POST['countsim'];
$hdd = $_POST['hdd'];

$os = $_POST['os'];

mysqli_query($connect, "INSERT INTO `phones` (`id`, `categories`, `name`, `price`, `ram`, `countsim`, `hdd`, `os`) VALUES (NULL, 'Phone', '$name', '$price', '$ram', '$countsim', '$hdd', '$os')");


header('Location: /PHP/HomeTask/dz oop 2/');