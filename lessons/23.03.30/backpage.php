<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
<?php 
    require_once('functions.php');
    isRequared($_POST["name"], 'Name');
    isRequared($_POST["email"], 'Email');
    isRequared($_POST["header"], 'Header');
    isRequared($_POST["message"], 'Message');
    isRequared($_POST["checkbox"], 'hf,j');

    ?>
</body>

</html>