<?php
require_once "../config/connect.php";

$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPassword = $_POST['userPassword'];
// $date = $_POST['date'];
$userMessage = $_POST['userMessage'];
$gender = $_POST['gender'];
$agree = $_POST['agree'];

mysqli_query($connect, "INSERT INTO `forms` (`id`, `userName`, `userEmail`, `userPassword`, `userMessage`, `gender`, `agree`) VALUES (NULL, '$userName', '$userEmail', '$userPassword', '$userMessage', '$gender', '$agree')");
header('Location: /GitHub/Forma/table/table.php');