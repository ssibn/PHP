<?php
$connect = mysqli_connect('localhost', 'root','', 'lesson');

if(!$connect){
    die('Dont coonect data base');
}