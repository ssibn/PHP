<?php
    require_once ('../config/connect.php');

    $id = $_POST['id'];
    $name = $_POST['userName'];
    $text = $_POST['userEmail'];
    $price = $_POST['userPassword'];
    $price = $_POST['userMessage'];
    $price = $_POST['gender'];
    $price = $_POST['agree'];

    mysqli_query($connect, "UPDATE `forms` SET `userName` = '$userName', `userEmail` = '$userEmail', `userPassword` = '$userPassword', `userMessage` = '$userMessage', `gender` = '$gender', `agree` = '$agree' WHERE `forms` . `id` = '$id' ");
    header('Location: /GitHub/Forma/table/table.php');
    