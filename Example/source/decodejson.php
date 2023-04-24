<?php
$jspoint=file_get_contents('jsonpoint.txt');
$obj=json_encode($jspoint);
var_dump($obj);

print_r(PDO::getAvailableDrivers());
?>