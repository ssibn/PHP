<?php
$priceMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(price) from `phones`"));
$priceMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(price) from `phones`"));

$ramMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(ram) from `phones`"));
$ramMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(ram) from `phones`"));

$countsimMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(countsim) from `phones`"));
$countsimMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(countsim) from `phones`"));

$hddMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(hdd) from `phones`"));
$hddMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(hdd) from `phones`"));

$priceMonMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(price) from `monitors`"));
$priceMonMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(price) from `monitors`"));

$diagonalMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(diagonal) from `monitors`"));
$diagonalMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(diagonal) from `monitors`"));

$frequencyMax = mysqli_fetch_all(mysqli_query($connect,"SELECT max(frequency) from `monitors`"));
$frequencyMin = mysqli_fetch_all(mysqli_query($connect,"SELECT min(frequency) from `monitors`"));