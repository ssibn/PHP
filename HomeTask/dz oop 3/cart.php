<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/smile.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    
    <title>Cart</title>
</head>
<body>
    <div class="task">
        <a class="nav-link text-center"  aria-disabled="false" href="./index.php">Back</a>
    </div>

    <?php
    require_once ('./config/tasks.php');
    ?>
    <div class="row">
        <div class="col">
            <?php 
            $connectOOP2 = mysqli_connect('localhost', 'root','root', 'dzoop2');
            $row = mysqli_fetch_all(mysqli_query($connectOOP2, "SELECT * FROM `phones`"));
            // var_dump($row) . "<br>";

            foreach ($row as $phone):
            $sessionId[] = new Products($phone[1], $phone[2], $phone[3], $phone[4], $phone[5], $phone[6]);
            endforeach;
            $countn = count($sessionId);

            for ($i = 0; $i < $countn; $i++) {
                echo $sessionId[$i] -> session() . "<br>";
            }
            ?>
        </div>
    </div>
    
     <script src="./js/script.js"></script>
     <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>