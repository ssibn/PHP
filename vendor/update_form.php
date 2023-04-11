<?php
require_once '../config/connect.php';

    $product_id = $_GET['id'];
    $product = mysqli_query($connect, "SELECT * FROM `products` WHERE `id` = '$product_id'"); 
    $product = mysqli_fetch_assoc($product);
    print_r($product);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Update product</h3>
        <input type="hiden" name="id" value="<?= $product['id'] ?>"><br>
        Name: <br>
        <input type="text" name="name" value="<?= $product['product_name'] ?>"><br>
        Text: <br>
        <input type="text" name="text" value="<?= $product['product_text'] ?>"><br>
        Price: <br>
        <input type="text" name="price" value="<?= $product['product_price'] ?>"><br>
        <button type="submit">Send</button>

    </form>
</body>
</html>