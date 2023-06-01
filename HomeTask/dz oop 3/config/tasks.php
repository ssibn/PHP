<?php
// <!-- Task 1 -->
class User
{
    public $name;
    public $email;

    function __construct($name, $email){
        $this -> name = $name;
        $this -> email = $email;
    }
    function getUser(){
        return $this -> name . ' - ' . $this -> email;
    }
}

// <!-- Task 2 -->
class NewUser extends User
{
    public $id;
    public $password;
    public $joinDate;

    function __construct ($id, $name, $password, $email, $joinDate)
    {
        User::__construct($name, $email);
        $this -> id = $id;
        $this -> password = $password;
        $this -> joinDate = $joinDate;
    }

    function __link ()
    {
        return 'ID: ' . $this -> id . '<br>Name: ' . $this -> name . '<br>Password: ' . $this -> password . '<br>Email: ' . $this -> email . '<br>Date registration: ' . $this -> joinDate;
    }
}
$polzovatel1 = new NewUser('id45364', 'Sergey', 'zeroPass', 'qwerty@sobaken.ru', '09-11-2023');
$polzovatel2 = new NewUser('id84734', 'Seva', 'ngnerhkrg', 'berta@sobaken.ru', '23-04-2023');
$polzovatel3 = new NewUser('id54424', 'Alexandr', 'unferfil', 'undef@sobaken.ru', '21-07-2022');
$polzovatel4 = new NewUser('id95935', 'Timofey', 'jvuijwejr', 'uber@sobaken.ru', '01-05-2021');
$polzovatel5 = new NewUser('id38550', 'Grinya', 'fergiugndt4', 'grinder@sobaken.ru', '14-04-2022');


// <!-- Task 4 -->
class History extends User
{
    public $date;
    public $sessionId;

    function __construct ($name, $email, $date, $sessionId)
    {
        $this -> date = $date;
        $this -> sessionId = $sessionId;
        User::__construct($name, $email);
    }
    function historyBuy()
    {
        return $this -> date . ' -  <a aria-disabled="false" href="./cart.php">' . $this -> sessionId . '</a>';
    }
}
$sergey = 
[
    new History('Sergey', '', '20-12-2022 12:34:53', '4562'),
    new History('Sergey', '', '25-02-2012 12:34:53', '3634'),
    new History('Sergey', '', '10-03-2020 12:34:53', '8673'),
    new History('Sergey', '', '14-06-2019 12:34:53', '3569'),
    new History('Sergey', '', '26-05-2021 12:34:53', '2577'),
];

class Products
{
    public $nameProd;
    public $price;
    public $ram;
    public $count;
    public $hdd;
    public $os;

    function __construct($nameProd, $price, $ram, $count, $hdd, $os)
    {
        $this -> nameProd = $nameProd;
        $this -> price = $price;
        $this -> ram = $ram;
        $this -> count = $count;
        $this -> hdd = $hdd;
        $this -> os = $os;
    }
    function session()
    {
        return '<p>Name: ' . $this -> nameProd . ', Price: ' . $this -> price . ', RAM: ' . $this -> ram . ', Count SIM: ' . $this -> count . ', HDD: ' . $this -> hdd . ', OS: ' . $this -> os . '</p>';
    }
};