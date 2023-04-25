<?php 
error_reporting (-1);
$anonDice1 = mt_rand (1, 6);
$anonDice2 = mt_rand (1, 6);

$compDice1 = mt_rand (1, 6);
$compDice2 = mt_rand (1, 6);

echo "y amONa BHIMaMO ($anonDice1) I ($anonDice2) \n y KOMIbIrepa ($compDice1) M ($compDice2) \n";

$anonSum = ($anonDice1 + $anonDice2);
$compSum = ($compDice1 - $compDice2);

if(($anonDice1 == $anonDice2) && ($compDice1 == $compDice2))
{
    echo "2 dabla!! \n";
    exit();
}
?>