<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/smile.png">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    
    <title>OOP 3</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarID">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="../dz oop 1">OOP 1</a>
                    <a class="nav-link active" aria-current="page" href="../dz oop 2">OOP 2</a>
                    <a class="nav-link active" aria-current="page" href="../dz oop 3">OOP 3</a>
                </div>
            </div>
        </div>
    </nav>
    <?php
    require_once ('./config/tasks.php');
    ?>
    <div class="task">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="text-center">Task 3</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a class="nav-link"  aria-disabled="false" href="./session.php"><?php echo $polzovatel1 -> getUser()?></a>
                    <a class="nav-link"  aria-disabled="false" href="./session.php"><?php echo $polzovatel2 -> getUser()?></a>
                    <a class="nav-link"  aria-disabled="false" href="./session.php"><?php echo $polzovatel3 -> getUser()?></a>
                    <a class="nav-link"  aria-disabled="false" href="./session.php"><?php echo $polzovatel4 -> getUser()?></a>
                    <a class="nav-link"  aria-disabled="false" href="./session.php"><?php echo $polzovatel5 -> getUser()?></a>
                </div>
            </div>
        </div>
    </div>

   
   
     <script src="./js/script.js"></script>
     <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>