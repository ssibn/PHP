<?php
$connect = mysqli_connect('localhost', 'root','', 'lesson');

if(!$connect){
    die('Dont coonect data base');
}

class Player {
    public hp;
    public hp;
    public hp;
    public hp;
    function __construct($hp=100) {
        $ftis->hp = $hp;
    }
    function __destruct() {
        echo "dead";
    }
}