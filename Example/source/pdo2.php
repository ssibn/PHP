<?php
	include_once('pdo1.php');
	$pdo=connect();
	$cname1="Brasil";
	$cname2="USA";
	$cname3="Ukraine";
	//first way of using prepared statements – 
	//no protection from SQL-injection
	//such usage should be avoided
	$ps1 = $pdo->prepare("INSERT INTO Countries (country) values 
		( '".$cname1."' )");  
	//executing the first prepared statements
	$ps1->execute(); 


	//second way of using prepared statements with noname placeholders
	//this statement provides protection from SQL-injection
	$ps2 = $pdo->prepare("INSERT INTO Countries (country) values 
		(?)");  
	//inserting parameter for the second prepared statements
	$ps2->bindParam(1, $cname2);  
	//executing the second prepared statements
	$ps2->execute();


	//third way of using prepared statements with named placeholders
	//this statement provides protection from SQL-injection
	$ps3 = $pdo->prepare("INSERT INTO Countries (country) values 
		( :country )");  
	//inserting parameter and executing the third prepared statements
	$ps3->execute(array("country" => $cname3));

	//SELECT in prepared statements
	$ps4 = $pdo->prepare("SELECT * FROM Countries");
	$list=$ps4->execute();
	$ps4 ->setFetchMode(PDO::FETCH_NUM);

	while ($row=$list->fetch())
	{
		echo $row[0].' '.$row[1].'<br/>';
	}
?>
