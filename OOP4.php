<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php
        class N1{
            protected $name = 'Mark';
        }
        class N2 extends N1{
            //
        }

        class N3 extends N2{
            function hello(){
                echo 'HI ' . $this->name . '!';
            }
        }
        
        $obj = new N3();
        $obj->hello();

    ?>

    <br>
    <a href='./index.php'>Back</a>

</body>
</html>