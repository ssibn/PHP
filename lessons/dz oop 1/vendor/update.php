<?php
    require_once ('../config/connect.php');

    $id = $_POST['id'];
    $name = $_POST['name'];
    $text = $_POST['text'];
    $price = $_POST['price'];

    mysqli_query($connect, "UPDATE `products` SET `product_name` = '$name', `product_text` = '$text', `product_price` = '$price' WHERE `products` . `id` = '$id' ");
    header('Location: /GitHub/OOP/lessons/');

    