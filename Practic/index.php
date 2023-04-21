<?php 
error_reporting (-1);
$anonDice1 = mt_rand (1, 6);
$anonDice2 = mt_rand (1, 6);

$compDice1 = mt_rand (1, 6);
$compDice2 = mt_rand (1, 6);

echo "y amONa BHIMaMO ($anonDice1) I ($anonDice2) \n y KOMIbIrepa ($compDice1) M ($compDice2) \n";

$anonSum = ($anonDice1 + $anonDice2);
$compSum = ($compDice1 - $compDice2);

if(($anonDice1 == $anonDice2) && ($compDice1 == $compDice2))
{
    echo "2 dabla!! \n";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP 1</title>
</head>
<body>
    <?php
    // First task
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
        $obj0 -> goods();

    // Second task
        class Category1
        {
            public $getCategoryName = 'Category';
        
            public function getCategoryName() {
                return 'New category';
            }

            public $getCategoryProducts = 'Products';
        
            public function getCategoryProducts() {
                return 'New products';
            }
        }
        
        $obj1 = new Category1();
        echo $obj1->getCategoryName, PHP_EOL, $obj->getCategoryName(), PHP_EOL;
        echo $obj1->getCategoryProducts, PHP_EOL, $obj->getCategoryProducts(), PHP_EOL;
    ?>
    <form action="source.php">
    <input type="text" name="name"><br>
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="price" placeholder="Price">
        <button type="submit">Add</button>
    </form>
    <form action="source.php">
        <input type="text" name="search" placeholder="Search">
        <button type="submit">Search</button>
    </form>
    <h3>Categories</h3>
    <form action="source.php">
        <input type="text" name="gadgets" placeholder="Gadgets">
        <button type="submit">Add</button>
    </form>
    <h3>Gadgets</h3>
</body>
</html>