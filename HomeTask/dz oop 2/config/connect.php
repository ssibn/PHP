<?php
$connect = mysqli_connect('localhost', 'root','root', 'dzoop2');

if(!$connect){
    die('Dont coonect data base');
}