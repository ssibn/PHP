<!DOCTYPE html>
<title>23.03.23</title>
<html>
    <body>
        <form name="feedback" action="index.php" method="POST">
            Name: <input type="text" /><br>
            E-mail: <input type="email" /><br>
            Number: <input type="number" /><br>
            Avatar: <input type="file" /><br>
            <button type="submit">Send</button>
        </form>
       
        <h1>It works!</h1>


        <div>x=</div>
        <input></input>
        <div>y=</div>
        <input></input>
        <br />
        <?php
        $txt = "PHP";
        echo "I love $txt!";

        $x = 56;
        $y = 4565;
        if($x < 0 && $y < 0){
        $sum = $x + $y;
        echo "$x + $y = <span style='color:green;'>$sum</span>";
        }
        elseif($x > 0 && $y > 0){
        $sum = $x + $y;

        echo "$x + $y = <span style='color:green;'>$sum</span>";

        }



        echo "<br />";
        $array = array("yellow" => array("banana", "sun", "gold"));
        echo $array["yellow"][2];
        echo "<br />";

        $array = array("cars" => array("banana", "sun", "gold"));
        echo $array["yellow"][2];
        echo "<br />";

        $array = array(3,5,567,0,3,-65,42,5,3);
        rsort($array);
        echo $array[0];
        echo "<br />";

        $x = 0;
        while($x !== 100){
            $x += 1;
            echo $x. "<br />";
        }
        echo "<br />";

        $x = array(56,54,667,57,75);
        rsort($x);
        for($i=0; $i<count($x); $i++){
            echo $x[$i] . "<br / >";
        }


        function AddNumbersColor($n1, $n2, $color){
            echo "Sum is: <span style='color:".$color.";'>".($n1+$n2)."</span><br />";
        }

        AddNumbersColor(54, 54, green);
        AddNumbersColor(67, $n2, $color);

        AddNumbersColor($n1, $n2, $color);

        AddNumbersColor($n1, $n2, $color);




        ?>

    </body>
</html>