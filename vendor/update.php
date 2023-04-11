<?php
    require_once ('./connect');

    $id = $_POST('id');
    $name = $_POST('name');
    $text = $_POST('text');
    $price = $_POST('price');

    mysqli_query($connect, "UPDATE `products` SET `product_name` = '$name' ");