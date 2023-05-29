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


            <div class="form-group">
            <select onchange="showSingleDiv(this.value)">
                <option disabled selected>Add product</option>
                <option value="#some-phones">Phones</option>
                <option value="#some-monitors">Monitors</option>
            </select>
            </div>

            <div id="some-phones" class="single">
                <form class="row g-3 needs-validation" action="./vendor/createCategoriesPhones.php" method="post">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price">
                </div>
                <div class="col-md-3" id="ram">
                    <label class="form-label">RAM</label>
                    <input type="number" class="form-control" name="ram">
                </div>
                <div class="col-md-4" id="countsim">
                    <label class="form-label">Count sim</label>
                    <input type="number" class="form-control" name="countsim">
                </div>
                <div class="col-md-4" id="hdd">
                    <label class="form-label">HDD</label>
                    <input type="number" class="form-control" name="hdd">
                </div>
                <div class="col-md-4" id="os">
                    <label class="form-label">OS</label>
                    <input type="text" class="form-control" name="os">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Add Phones</button>
                </div>
            </form>
        </div>
            <div id="some-monitors" class="single">
            <form class="row g-3 needs-validation" action="./vendor/createCategoriesMonitors.php" method="post">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price">
                </div>
                <div class="col-md-6" id="diagonal">
                    <label class="form-label">Diagonal</label>
                    <input type="number" class="form-control" name="diagonal">
                </div>
                <div class="col-md-6" id="frequency">
                    <label class="form-label">Frequency</label>
                    <input type="number" class="form-control" name="frequency">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Add Monitors</button>
                </div>
            </form>
            </div>
            <div class="single" data-some-attr="any">блок с data-атрибутом</div>

                    
            

            
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
            require_once ('./vendor/task5.php');
            $categories = $_GET['categories'];

            $products = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `category` WHERE `categories` = '$categories'"));
            $productsPho = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `phones` WHERE `categories` = '$categories'"));
            $productsMon = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `monitors` WHERE `categories` = '$categories'"));

            $name = mysqli_fetch_all( mysqli_query($connect, "SELECT DISTINCT `categories` FROM `category`"));

            function addWhere($where, $add, $and = true) {
                if ($where) {
                    if ($and) $where .= " AND $add";
                    else $where .= " OR $add";
                }
                else $where = $add;
                return $where;
            }

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

            foreach ($products as $product):
            endforeach; 
            if ($product[1] == "Phone") 
            { ?>
                <form class="row g-3 needs-validation" method="post">
                <div class="col-md">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="priceSearch" placeholder='<?= $priceMin[0][0] ?> - <?= $priceMax[0][0] ?>' value=''>
                </div>
                <div class="col-md">
                    <label class="form-label">RAM</label>
                    <input type="number" class="form-control" name="ramSearch" placeholder='<?= $ramMin[0][0] ?> - <?= $ramMax[0][0] ?>' value=''>
                </div>
                <div class="col-md">
                    <label class="form-label">SIMs</label>
                    <input type="number" class="form-control" name="countsimSearch" placeholder='<?= $ramMin[0][0] ?> - <?= $ramMax[0][0] ?>' value=''>
                </div>
                <div class="col-md">
                    <label class="form-label">HDD</label>
                    <input type="number" class="form-control" name="hddSearch" placeholder='<?= $hddMin[0][0] ?> - <?= $hddMax[0][0] ?>' value=''>
                </div>
                <div class="col-md">
                    <button disabled id = "button" class="btn btn-primary" name="submit" type="submit">Apply</button>


                </div>
            </form>
            <?php

            function zaprosPhone() {
                $where = "";
                if ($_POST["priceSearch"]) $where = addWhere($where, "`price` = '".htmlspecialchars($_POST["priceSearch"]))."'";
                if ($_POST["ramSearch"]) $where = addWhere($where, "`ram` = '".htmlspecialchars($_POST["ramSearch"]))."'";
                if ($_POST["countsimSearch"]) $where = addWhere($where, "`countsim` = '".htmlspecialchars($_POST["countsimSearch"]))."'";
                if ($_POST["hddSearch"]) $where = addWhere($where, "`hdd` = '".htmlspecialchars($_POST["hddSearch"]))."'";
                $sql = 'SELECT * FROM `phones`';
                if ($where) $sql .= " WHERE $where";
                return $sql;
            };
            $func = 'zaprosPhone';

            if (isset($_POST['submit'])){
                $row = mysqli_fetch_all(mysqli_query($connect, $func()));

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
                        </tr>
                    </thead>
                <tbody> 
                <?php
                foreach ($row as $phone): ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $phone[2] ?></th>
                            <td><?= $phone[3] ?></td>
                            <td><?= $phone[4] ?></td>
                            <td><?= $phone[5] ?></td>
                            <td><?= $phone[6] ?></td>
                            <td><?= $phone[7] ?></td>
                        </tr>
                        <?php endforeach ?> 
                    </tbody>
                </tbody>
            </table> <?php
            } else {

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
                    </tr>
                </thead>
                <?php
                foreach ($productsPho as $phone): ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $phone[2] ?></th>
                        <td><?= $phone[3] ?></td>
                        <td><?= $phone[4] ?></td>
                        <td><?= $phone[5] ?></td>
                        <td><?= $phone[6] ?></td>
                        <td><?= $phone[7] ?></td>
                    </tr>
                    <?php endforeach ?> 
                </tbody>
            </table>
            <?php
            }

            } else if ($product[1] == "Monitor") 
            { ?>
                <form class="row g-3 needs-validation" method="post">
                <div class="col-md">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" name="priceSearch" placeholder='<?= $priceMonMin[0][0] ?> - <?= $priceMonMax[0][0] ?>'>
                </div>
                <div class="col-md">
                    <label class="form-label">Diagonal</label>
                    <input type="text" class="form-control" name="diagonalSearch" placeholder='<?= $diagonalMin[0][0] ?> - <?= $diagonalMax[0][0] ?>'>
                </div>
                <div class="col-md">
                    <label class="form-label">Frequency</label>
                    <input type="text" class="form-control" name="frequencySearch" placeholder='<?= $frequencyMin[0][0] ?> - <?= $frequencyMax[0][0] ?>'>
                </div>
                <div class="col-md">
                    <button disabled id = "button" class="btn btn-primary" name="submit" type="submit">Apply</button>
                </div>
            </form>
            <?php
            function zaprosMonitor() {
                $where = "";
                if ($_POST["priceSearch"]) $where = addWhere($where, "`price` = '".htmlspecialchars($_POST["priceSearch"]))."'";
                if ($_POST["diagonalSearch"]) $where = addWhere($where, "`diagonal` = '".htmlspecialchars($_POST["diagonalSearch"]))."'";
                if ($_POST["frequencySearch"]) $where = addWhere($where, "`frequency` = '".htmlspecialchars($_POST["frequencySearch"]))."'";
                $sql = 'SELECT * FROM `monitors`';
                if ($where) $sql .= " WHERE $where";
                return $sql;
            };
            $func = 'zaprosMonitor';

            if (isset($_POST['submit'])){
                $row = mysqli_fetch_all(mysqli_query($connect, $func()));
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Diagonal</th>
                            <th scope="col">Frequency</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($row as $monitor): ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $monitor[2] ?></th>
                            <td><?= $monitor[3] ?></td>
                            <td><?= $monitor[4] ?></td>
                            <td><?= $monitor[5] ?></td>
                        </tr>
                    <?php endforeach ?> 
                    </tbody>
                </table> <?php
            } else {
            ?> 
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Diagonal</th>
                        <th scope="col">Frequency</th>
                    </tr>
                </thead>
                <?php
                foreach ($productsMon as $monitor): ?>
                <tbody>
                    <tr>
                        <th scope="row"><?= $monitor[2] ?></th>
                        <td><?= $monitor[3] ?></td>
                        <td><?= $monitor[4] ?></td>
                        <td><?= $monitor[5] ?></td>
                    </tr>
                <?php endforeach ?> 
                </tbody>
            </table>
            <?php
            }
        }
        ?>
        </div>
    </div>
   
    
     <script src="./js/script.js"></>
     <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>