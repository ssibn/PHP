<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/smile.png">
    <link rel="stylesheet" href="./css/style.css">
    
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
                public $listProducts;

                function __construct($name = "", $filters = "Price"){
                    $this -> name = $name;
                }
            }
        ?>
        <!-- если правильно понял задание -->
    </div>

    <div class="task">
    <h3>Task 2</h3>

        <?php
        class PhoneCategory extends Category{
            function __construct($filters = ["Ram", "CountSim", "Hdd", "OS"]){
                Category:: __construct($filters);
                //
            }
        }
        ?>
    </div>

    <div class="task">
    <h3>Task 3</h3>

        <?php
        class MonitorCategory extends Category{
            function __construct($filters = ["Diagonal ", "Frequency"]){
                Category:: __construct($filters);
                //
            }
            function Show(){
                return print_r($filters);
            }

        }
        $test = new MonitorCategory();
        $test->Show();
        ?>
    </div>

    <?php

class User
{
  private $data = array();

  private $name;
  protected $age;
  public $salary;

  public function __set($name, $value)
  {
    $this->data[$name] = $value;
  }
}

$user = new User();
$user->name = 'John';
$user->age = 34;
$user->salary = 4200.00;
$user->message = 'hello';

var_dump($user);



class User1
{
  protected $name;
  protected $age;

  public function __construct($name, $age)
  {
    $this->name = $name;
    $this->age = $age;
  }

  public function __toString()
  {
    return $this->name . ', age ' . $this->age;
  }
}

$user = new User1('John', 34);
echo $user;





class Point
{
	public $x;
  	public $y;
	function __construct($x, $y)
	{
		$this->x=$x;
		$this->y=$y;
	}
	function Show()
	{
		echo 'Vertex: ('.$this->x.','.$this->y.') <br/>';
	}
}
$p=new Point (100,200);
$p->Show();
$jspoint=json_encode($p);
echo $jspoint.'<br/>';
file_put_contents('jsonpoint.txt',$jspoint);

?>

     <h2>Как мог <img src="./img/smile.png" alt="">  За дизайн простите и ошибки если найдете</h2>

    <script src="js/app.js"></script>
</body>
</html>