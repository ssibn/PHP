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
            <div class="row">
            <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menugi</option>
            <option value="1"><? $phone = echo "Phone"?></option>
            <?php
            if (isset($phone)){
                {
                ?>
                    <ul>
                        <li name="liname">productValue[1]?></li>
                        <li name="liprice">productValue[2]?></li>
                    </ul>
                <?php
                } 
            }
            ?>
            <option value="2">Monitor</option>
            </select>
            </div>
        </div>
    </div>

    <div class="task">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Task 5</h3>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Brand</th>
                    <th scope="col">CPU</th>
                    <th scope="col">RAM</th>
                    <th scope="col">Count</th>
                    <th scope="col">HDD</th>
                    <th scope="col">OS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry the Bird</td>
                    <td>@twitter</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    </tr>
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