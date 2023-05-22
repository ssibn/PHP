<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/smile.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    
    <title>OOP 2</title>
</head>
<body>
    <div class="task">
        <h3>Task 1</h3>
        <?php
            class Category
            {
                public $name;
                public $filters;
                public $price;
                public $listProducts;

                function __construct($name, $filters, $price, $listProducts){
                    $this -> name = $name;
                    $this -> filters = $filters;
                    $this -> price = $price;
                    $this -> listProducts = $listProducts;
                }
                function __name(){
                    echo $this -> name . ': ';
                }
                function __filters(){
                    return $this -> price . '$ ';
                }
                function _name($y){
                    $this -> name = $y;
                    echo $this -> name . ': ';
                }
                function _filters($x){
                    $this -> price = $x;
                    echo $this -> price . '$';
                }
            }
            $obj = new Category('One Plus', '', '1599', '');
            $obj -> __name();
            echo $obj -> __filters();
            echo "<br>";
            $obj -> _name("iPhone");
            $obj -> _filters(999);
            echo "<br>";
        ?>
        <!-- если правильно понял задание -->
    </div>

    <div class="task">
        <h3>Task 2</h3>
        <?php
            class PhoneCategory extends Category{
                public $ram;
                public $countSim;
                public $hdd;
                public $os;
                function __construct($name, $price, $ram, $countSim, $hdd, $os){
                    Category::__construct($name, $filters, $price, $listProducts);
                    $this -> ram = $ram;
                    $this -> countSim = $countSim;
                    $this -> hdd = $hdd;
                    $this -> os = $os;
                }
                function __filters(){
                    return parent::__name() . ' ' . Category::__filters() . $this -> ram . 'Gb ' . $this -> countSim . 'sim ' . $this -> hdd . 'Gb ' . $this -> os;
                }
            }
            $obj = new PhoneCategory('iPhone','999','3','1','256','iOs');
            echo $obj -> __filters();

        ?>
    </div>

    <div class="task">
        <h3>Task 3</h3>
        <?php
        class MonitorCategory extends Category{
            public $diagonal;
            public $frequency;
            function __construct($name, $price, $diagonal, $frequency){
                Category::__construct($name, $filters, $price, $listProducts);
                $this -> diagonal = $diagonal;
                $this -> frequency = $frequency;
                
            }
            function __filters(){
                return $this -> name . ' ' . $this ->  price . '$ ' . $this -> diagonal . 'inch ' . $this -> frequency . 'Hz';
            }
        }
        $obj = new MonitorCategory('iPad','1999','13','120');
        echo $obj -> __filters();
        ?>
    </div>

    <div class="task">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Task 4</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-1">
                    <h4>Category</h4>
                </div>
            </div>
            <!-- ALTER TABLE `category` CHANGE `price` `price` INT(11) NULL DEFAULT NULL, CHANGE `ram` `ram` INT(11) NULL DEFAULT NULL, CHANGE `countsim` `countsim` INT(11) NULL DEFAULT NULL, CHANGE `hdd` `hdd` INT(11) NULL DEFAULT NULL, CHANGE `os` `os` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `diagonal` `diagonal` INT(11) NULL DEFAULT NULL, CHANGE `frequency` `frequency` INT(11) NULL DEFAULT NULL; изменить таблицу -->

            <!-- ALTER TABLE `category` ADD `колонка` INT NULL DEFAULT NULL AFTER `после этой`; добавить колонку в таблицу-->

            <!-- ALTER TABLE `category` DROP `колонка`; удалить колонку -->

            <!-- DELETE FROM category WHERE `category`.`id` = 10 -->

            <!-- Это для себя -->
            <form class="row g-3 needs-validation" action="./vendor/createCategories.php" method="post">
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label">Name Category</label>
                    <select class="form-select" name="categories">
                        <option value="Phone">Phone</option>
                        <option value="Monitor">Monitor</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price">
                </div>
                <div class="col-md-4">
                    <label class="form-label">RAM</label>
                    <input type="text" class="form-control" name="ram">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Count sim</label>
                    <input type="text" class="form-control" name="countsim">
                </div>
                <div class="col-md">
                    <label class="form-label">HDD</label>
                    <input type="text" class="form-control" name="hdd">
                </div>
                <div class="col-md">
                    <label class="form-label">OS</label>
                    <input type="text" class="form-control" name="os">
                </div>
                <div class="col-md">
                    <label class="form-label">Diagonal</label>
                    <input type="text" class="form-control" name="diagonal">
                </div>
                <div class="col-md">
                    <label class="form-label">Frequency</label>
                    <input type="text" class="form-control" name="frequency">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>

    <div class="task">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Task 5</h3>
                </div>
            </div>
            <?php
            require_once ('./config/connect.php');
            $name = mysqli_query($connect, "SELECT DISTINCT `categories` FROM `category`");
            $name = mysqli_fetch_all($name);
            foreach ($name as $nameValue)
            {
                $result = array_unique($nameValue);
                foreach ($result as $value){
                    $categori = $result[0];
                    ?>
                <a href='./index.php?categories=<?= $result[0] ?>'><h3><?= $result[0] ?></h3></a>
                <?php
                }
            }
            $categories = $_GET['categories'];
            $products = mysqli_query($connect, "SELECT * FROM `category` WHERE `categories` = '$categories'"); 
            $products = mysqli_fetch_all($products);
            foreach ($products as $product):
            endforeach; 
            if ($product[1] == "Phone") 
            { ?>
                <form class="row g-3 needs-validation" action="./vendor/createCategories.php" method="post">
                <div class="col-md">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" placeholder='price'>
                </div>
                <div class="col-md">
                    <label class="form-label">RAM</label>
                    <input type="text" class="form-control" name="ram">
                </div>
                <div class="col-md">
                    <label class="form-label">SIMs</label>
                    <input type="text" class="form-control" name="countsim">
                </div>
                <div class="col-md">
                    <label class="form-label">HDD</label>
                    <input type="text" class="form-control" name="hdd">
                </div>
                <div class="col-md">
                    <button class="btn btn-primary" name="submit" type="submit">Apply</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])){
                $search = $_POST["search"];
                $price = $_POST["price"];
                $ram = $_POST["ram"];
                $countsim = $_POST["countsim"];
                $hdd = $_POST["hdd"];
                $query = mysqli_query($connect, "SELECT * FROM `categor` WHERE `categoryName` LIKE '%$search%' ");
                $row = mysqli_fetch_assoc($query);
                echo "<h3>Result</h3><h4>" . $row['categoryName'] . "</h4><p>" . $row['categoryName'] . " - " . $row['liname'] . " : " . $row['liprice'] . "</p>"; 
                while($row = mysqli_fetch_assoc($query)) echo "<p>" . $row['categoryName'] . " - " . $row['liname'] . " : " . $row['liprice'] . "</p>";
            }
            } else if ($product[1] == "Phone") { ?>
                <form class="row g-3 needs-validation" action="./vendor/createCategories.php" method="post">
                <div class="col-md">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="price" placeholder='price'>
                </div>
                <div class="col-md">
                    <label class="form-label">RAM</label>
                    <input type="text" class="form-control" name="ram">
                </div>
                <div class="col-md">
                    <label class="form-label">SIMs</label>
                    <input type="text" class="form-control" name="countsim">
                </div>
                <div class="col-md">
                    <label class="form-label">HDD</label>
                    <input type="text" class="form-control" name="hdd">
                </div>
                <div class="col-md">
                    <button class="btn btn-primary" name="submit" type="submit">Apply</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])){
                $search = $_POST["search"];
                $price = $_POST["price"];
                $ram = $_POST["ram"];
                $countsim = $_POST["countsim"];
                $hdd = $_POST["hdd"];
                $query = mysqli_query($connect, "SELECT * FROM `categor` WHERE `categoryName` LIKE '%$search%' ");
                $row = mysqli_fetch_assoc($query);
                echo "<h3>Result</h3><h4>" . $row['categoryName'] . "</h4><p>" . $row['categoryName'] . " - " . $row['liname'] . " : " . $row['liprice'] . "</p>"; 
                while($row = mysqli_fetch_assoc($query)) echo "<p>" . $row['categoryName'] . " - " . $row['liname'] . " : " . $row['liprice'] . "</p>";
            }
            }
             ?> 
            


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">RAM</th>
                        <th scope="col">Count sim</th>
                        <th scope="col">HDD</th>
                        <th scope="col">OS</th>
                        <th scope="col">Diagonal</th>
                        <th scope="col">Frequency</th>
                    </tr>
                </thead>
                <?php
                foreach ($products as $product): ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $product[2] ?></th>
                        <td><?= $product[3] ?></td>
                        <td><?= $product[4] ?></td>
                        <td><?= $product[5] ?></td>
                        <td><?= $product[6] ?></td>
                        <td><?= $product[7] ?></td>
                        <td><?= $product[8] ?></td>
                        <td><?= $product[9] ?></td>
                    </tr>
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
<?php
    class HTMLTables extends Tables{
        public $cellpading = '2';
        public $bgcolor;

        function __construct($headers, $bg='FFFFFF'){
            Tables::__construct($headers);
            $this->bgcolor = $bg;
        }

        function __destruct(){
            echo "dead";
        }
        function setPadding($padding){
            $this->cellpadding = $padding;
        }
        function output(){
            echo "<table cellpading='" . $this->cellpading . "'><tr>";
            foreach($this->headers as $header) 
                echo "<th bgcolor='" . $this->bgcolor . "'>" . $header;
            foreach($this->data as $y)
            {
                echo "<tr>";
                foreach($y as $x)
                    echo "<td bgcolor='" . $this->bgcolor . "'>$x";
            }
            echo "</table>";
        }
    }

    $test = new HTMLTables(array('a', 'b', 'c', 'e', 'x'), '#00FFFF');
    $test->setPadding(7);
    $test->addRow(array('a' => 1, 'b' => 4, 'c' => 6, 'e' => 7, 'x' => 9));
    $test->addRow(array('a' => 1, 'b' => 2, 'c' => 5, 'e' => 8, 'x' => 11));
    $test->addRow(array('a' => 1, 'b' => 4, 'c' => 6, 'e' => 7, 'x' => 9));
    $test->addRow(array('a' => 1, 'b' => 4, 'c' => 6, 'x' => 9));
    $test->output();
    $test2 = clone $test;
    unset($test);
    $test2->output();
?>

     <h2>Как мог <img src="./img/smile.png" alt="">  За дизайн простите и ошибки если найдете</h2>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>