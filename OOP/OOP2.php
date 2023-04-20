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
   
<body>
    
    <?php
        class Name{

        private $name;
        private $secondname;
        private $age;
        

        
        function __construct($x = "", $y = "", $z = 16, $grnder = true){
            $this -> name = $x;
            $this -> secondname = $y;
            $this -> age = $z;
        }
        function hello(){
           
            echo "Hello " . $this -> name . ' ' . $this -> secondname . '!<br>';
        }
        function age(){
           
            echo "Hello " . $this -> age . 'age!<br>';
        }
    }
    $obj0 = new Name();
    $obj1 = new Name("Max", "Statham");
    $obj2 = new Name("Den", "Robot");

    $obj0 -> hello();
    $obj0 -> age();
    $obj1 -> hello();
    $obj1 -> age();
    $obj2 -> hello();
    $obj2 -> age();


    ?>

    <br>
    <a href='./index.php'>Back</a>

    
</body>

</html>