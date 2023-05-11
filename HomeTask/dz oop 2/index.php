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
                function _filters(){
                    $this -> price;
                }
            }
        ?>
        <!-- если правильно понял задание -->
    </div>

    <div class="task">
        <h3>Task 2</h3>
        <?php
        class PhoneCategory extends Category{
            public $phone;
            public $ram;
            public $countSim;
            public $hdd;
            public $os;
            function __construct($ram, $countSim, $hdd, $os){
                parent::__construct($filters, $price);
                $this -> ram = $ram;
                $this -> countSim = $CountSim;
                $this -> hdd = $hdd;
                $this -> os = $os;
            }
            function _filters(){
                parent::_filters();
                $this -> ram = $ram;
                $this -> countSim = $CountSim;
                $this -> hdd = $hdd;
                $this -> os = $os;
            }
        }
        ?>
    </div>

    <div class="task">
        <h3>Task 3</h3>
        <?php
        class MonitorCategory extends Category{
            public $diagonal;
            public $frequency;
            function __construct($diagonal, $frequency){
                parent:: __construct($filters, $price);
                $this -> diagonal = $diagonal;
                $this -> frequency = $frequency;
                
            }
            function _filters(){
                parent::_filters();
                $this -> diagonal = $diagonal;
                $this -> frequency = $frequency;
            }
        }
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
            <option selected>Open this select menu</option>
            <option value="1">Phone</option>
            <option value="2">Monitor</option>
            </select>
            </div>
        </div>
    </div>

    


     <h2>Как мог <img src="./img/smile.png" alt="">  За дизайн простите и ошибки если найдете</h2>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>