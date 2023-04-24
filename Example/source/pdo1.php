<?php
	function connect(
		$host="localhost:3307",
		$user="root",
		$pass="123456",
		$dbname="travels")
	{
		$cs='mysql:host='.$host.';dbname='.$dbname.';charset=utf8;';

		$options=array(
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
			PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
		);

		try 
		{
  		$pdo=new PDO($cs,$user,$pass,$options);
			return $pdo;
  	}
		catch(PDOException $e) 
		{
  		echo $e->getMessage();
  		return false;
		}
	}

	$pdo=connect();
	
	$list=$pdo->query('select * from countries');
	while ($row=$list->fetch())
	{
		echo $row['id'].' '.$row['country'].'<br/>';
	}
?>