<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/smile.png">
    <link rel="stylesheet" href="./css/style.css">
    
    <title>OOP 1</title>
</head>
<body>
    <div class="task">
    <?php 
        echo "<h3>Сыграем в кости? просто обнови страницу, но вообще это легко))</h3> Кто победил решай Сам)) мне некогда счет вести<br>";
        error_reporting (-1);
        $anonDice1 = mt_rand (1, 6);
        $anonDice2 = mt_rand (1, 6);

        $compDice1 = mt_rand (1, 6);
        $compDice2 = mt_rand (1, 6);

        echo "У тебя ($anonDice1) и ($anonDice2) <br>У компьютера ($compDice1) и ($compDice2)<br>";

        $anonSum = ($anonDice1 + $anonDice2);
        $compSum = ($compDice1 + $compDice2);

        if(($anonDice1 == $anonDice2) && ($compDice1 == $compDice2))
        {
            echo " 2 дабла!! \n";
            exit();
        }
    ?>
    </div>
    <div class="task">
        <h3>First Task</h3>
    <?php
        class Category0
        {
            public $name;
            public $list_product;

            function __construct($x = "", $z = "") 
            {
                $this->name = $x;
                $this->list_product = $z;
            }
            function goods()
            {
                echo "Price of the " . $this -> name . " is " . $this -> list_product . "<br>";
            }
        }
        $obj0 = new Category0("Nuts", "Hazelnuts");
        $obj0 -> goods(); ?>
    </div>
    <div class="task">
    <?php
        echo "<h3>Second Task</h3>";

        class Category1
        {
            public $getCategoryName = 'Category';
        
            public function getCategoryName() {
                return 'New category<br>';
            }

            public $getCategoryProducts = 'Products';
        
            public function getCategoryProducts() {
                return 'New products<br><br>';
            }
        }
        
        $obj1 = new Category1();
        echo $obj1->getCategoryName(), $obj1->getCategoryName();
        echo $obj1->getCategoryProducts(), $obj1->getCategoryProducts();
    ?>
    </div>

    <div class="task">
        <h3>Third task</h3>
    
        <p>Сначала добавляем продукт, потом пишем название категории и продукт полетит в категорию. Регулярки не делал, так что где название: буквы, где прайс: соответственно цифры. </p>
    
        <form action="./vendor/createProduct.php" method="post">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="price" placeholder="Price">
            <button type="submit">Add</button>
        </form>
        <?php
            require_once ('./config/connect.php');
            $product = mysqli_query($connect, "SELECT * FROM `product`");
            $product = mysqli_fetch_all($product);
            foreach ($product as $productValue)
            {
                ?>
                <h3>Categories</h3>
                <form action="./vendor/createCategories.php" method="post">
                    <input type="hidden" name="liname" value="<?= $productValue[1]?>">
                    <input type="hidden" name="liprice" value="<?= $productValue[2]?>">
                    <input type="text" name="categoryName" placeholder="Gadgets">
                    <button type="submit">Add</button>
                    <?php
            }
            if ($productValue[1] != null)
            {
                ?>
                <ul>
                    <li name="liname"><?= $productValue[1]?></li>
                    <li name="liprice"><?= $productValue[2]?></li>
                </ul>
                <?php
            } 
            else 
            {
                echo " ";
            }
            ?>
        </form>
    </div>
    
    <div class="task">
    <h3>Fourth task</h3>
    
    <p>Я не стал делать как на картинке в задании, т.к. с моей точки зрения это не логично. Кстати здесь тоже регулярок нет по этому может искать не по полному слову. Намеренно сделал отображение категорий, т.к. при схожих названиях может отображать продукты из других категорий. Наберите qw и поймете о чем я, в принципе с уникальными названиями таких проблем быть не должно. хотя qw могли удалить.. но наврядли </p>
    
    <form method="post">
        <input type="text" name="search" placeholder="Search" required>
        <button type="submit" name="submit" value="search">Search</button>
    </form>
    
    <?php

    if (isset($_POST['submit'])){
        $search = $_POST["search"];
        $query = mysqli_query($connect, "SELECT * FROM `categories` WHERE `categoryName` LIKE '%$search%' ");
        $row = mysqli_fetch_assoc($query);
        echo "<h3>Result</h3><h4>" . $row['categoryName'] . "</h4><p>" . $row['categoryName'] . " - " . $row['liname'] . " : " . $row['liprice'] . "</p>"; 
        while($row = mysqli_fetch_assoc($query)) echo "<p>" . $row['categoryName'] . " - " . $row['liname'] . " : " . $row['liprice'] . "</p>";
    }
    ?>
    </div>

    <div class="task">
        <h3>Fifth task</h3>
        <div>
        <p>Кнопочку удаления все таки пристроил, с ней как то по интересней</p>
        <?php
            $categories = mysqli_query($connect, "SELECT DISTINCT `categoryName` FROM `categories`");
            $categories = mysqli_fetch_all($categories);
            foreach ($categories as $categoriesValue)
            {
                $result = array_unique($categoriesValue);
                foreach ($result as $value){
                    $categori = $result[0];
                ?>
                <a href='./index.php?id=<?= $result[0] ?>'><h3><?= $result[0] ?>
                <?php
                if ($result[0] == "qw" || $result[0] == "qwerty"){
                    echo " ";
                } else { ?>
                 <a style="color: red" href='./vendor/delete.php?id=<?= $result[0] ?>'>Delete</a>
                <?php } ?> </h3></a>
                <?php
                }
                // print_r($categories);
            }
    
            $product_id = $_GET['id'];
            $products = mysqli_query($connect, "SELECT * FROM `categories` WHERE `categoryName` = '$product_id'"); 
            $products = mysqli_fetch_all($products);
            foreach ($products as $product): ?>
            <?php endforeach ?> 
            
        <h3>Вы выбрали: <?= $product[1] ?></h3>

        <h4>В этой категории:</h4>
        <?php
        foreach ($products as $product): ?>
        <p><?= $product[2] ?> : <?= $product[3] ?></p>
        <?php endforeach ?> 
    </div>

     <h2>Как мог <img src="./img/smile.png" alt="">  За дизайн простите и ошибки если найдете</h2>

    <script src="js/app.js"></script>
</body>
</html>