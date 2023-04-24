<?php
$connect = mysqli_connect('localhost', 'root','root', 'forma');

if(!$connect){
    die('Dont coonect data base');
}