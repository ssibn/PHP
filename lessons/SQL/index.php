<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <style>
        th{
            font-size: 14px;
            font-weight: 500;
            padding: 2px;
            border: 2px solid black;
        };
    </style>
    <?php
        require_once ('./config/connect.php'); //импортируем код из файла
    ?>
<body>
    ADD
    ADD CONSTRAINT
    ALTER
    ALTER COLUMN
    ALTER TABLE 
    ALL 
    AND
    ANY
    AS
    ASC
    BETWEEN
    CHECK
    DEFAULT
    DECS
    MIN, MAX
    GROUP BY
    INDEX
    LEFT JOIN
    RIGTH JOIN
    TOP
    UNION
    UNION ALL
    TRUNCATE TABLE

    

    <table>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
        <?php
            $products = mysqli_query($connect, "SELECT * FROM `products`"); //создаём переменную и указываем переменную из файла и sql запрос на всю таблицу
            $products = mysqli_fetch_all($products); //парсим полученный объект из sql запроса
            foreach ($products as $product){  //перебираем продукты циклом
                ?>
                    <tr>
                        <th><?= $product[0]?></th>
                        <th><?= $product[1]?></th>
                        <th><?= $product[2]?></th>
                        <th><?= $product[3]?> $</th>
                        <th><a href='./vendor/update_form.php?id=<?= $product[0] ?>'>Update</a>
                        <th><a style="color: red" href='./vendor/delete.php?id=<?= $product[0] ?>'>Delete</a>
                        </th>

                    </tr>
                <?php
            }
        // echo "<pre>"; //дополнительно вывели полученный объект с указанием типов данных
        // var_dump($products);
        // echo "</pre>";
        ?>
    </table>
    <form action="./vendor/create.php" method="post">
        Name: <br>
        <input type="text" name="name"><br>
        Text: <br>
        <input type="text" name="text"><br>
        Price: <br>
        <input type="text" name="price"><br>
        <button type="submit">Send</button>

    </form>
    <br>
    <a href='./oop.php'>OOP</a>
    <br>
    <a href='./oop2.php'>OOP2</a>
    <br>
    <a href='./oop3.php'>OOP3</a>
    <br>
    <a href='./oop4.php'>OOP4</a>
    <br>
    <a href='./oop5.php'>OOP5</a>

</body>

</html>