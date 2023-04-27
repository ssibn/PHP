<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <style>
       
    </style>
    
<body>
    <?php
        $str = "Цапля чахла, цапля сохла, цапля высохла и сдохла <br>";
        $pattern = "/Цапля/i";
        if (preg_match($pattern, $str))
        {
            echo "find <br>";
        } 
        else
        {
            echo "not find <br>";
        }

        $str = "Цапля чахла, цапля сохла, цапля высохла и сдохла <br>";
        $pattern = "/цапля/i";
        preg_replace($pattern, 'Цапля', $str);
        echo preg_replace($pattern, 'Цапля', $str);

        $str = "Цапля чахла, цапля сохла, цапля высохла и сдохла <br>";
        $pattern = "/[^Ц]/i";
        echo preg_match_all($pattern, $str);

        $str = "Цапля чахла, цапля сохла, цапля высохла и сдохла <br>";
        $pattern = "/\b/i";
        echo preg_match_all($pattern, $str);
        
    ?>
            
    <br>
    <a href='./oop.php'>OOP</a>
    <br>
    <a href='./oop2.php'>OOP2</a>
    <br>
    <a href='./oop3.php'>OOP3</a>
    <br>
    <a href='./oop4.php'>OOP4</a>
    <br>
    <a href='./oop5.php'>OOP5</a>

</body>

</html>