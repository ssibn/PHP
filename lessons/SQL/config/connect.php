<?php
$connect = mysqli_connect('localhost', 'root','', 'crud');
// $connect = new mysqli('localhost', 'root','', 'crud');
// $connect->query("DROP TABLE");

if(!$connect){
    die('Dont coonect data base');
}
misqli_set_charset($connect, 'utf8mb4');