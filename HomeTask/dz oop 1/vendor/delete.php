<?php
    require_once ('../config/connect.php');

    $id = $_GET['id']; // по факту здесь не id принимается, а categoryName, но менять не хочу, оставлю на память
    
    mysqli_query($connect, "DELETE FROM `categories` WHERE `categories` . `categoryName` = '$id' ");
    header('Location: /PHP/HomeTask/dz oop 1/');
// можно не только по id удалять))
