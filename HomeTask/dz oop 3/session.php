<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/smile.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    
    <title>Session</title>
</head>
<body>
    <?php
    require_once ('./config/tasks.php');
    
    ?>
    <div class="task">
        <a class="nav-link text-center"  aria-disabled="false" href="./index.php">Back</a>
    </div>
    <?php 
    // var_dump($sergey);

    $count = count($sergey);
    for ($i = 0; $i < $count; $i++) {
        echo $sergey[$i] -> historyBuy() . "<br>";
    }
    ?>

    
     <script src="./js/script.js"></script>
     <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>