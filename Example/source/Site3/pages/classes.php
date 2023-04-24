﻿<?php 
class Tools
{
	static function connect(
		$host="localhost:3307",
		$user="root",
		$pass="123456",
		$dbname="shop")
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

	static function register($name,$pass,$imagepath)
	{
		$name=trim($name);
		$pass=trim($pass);
		$imagepath =trim($imagepath);
		if ($name=="" || $pass=="" ) 
		{
			echo "<h3/><span style='color:red;'>
			Fill All Required Fields!</span><h3/>";
			return false;		
		}
		if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) 
		{
			echo "<h3/><span style='color:red;'>
			Values Length Must Be Between 3 And 30!</span><h3/>";
			return false;		
		}

		Tools::connect();
		$customer=new Customer($name,$pass, $imagepath);	
		$err=$customer->intoDb();
		if ($err)
		{
			if($err==1062)
				echo "<h3/><span style='color:red;'>
				This Login Is Already Taken!
				</span><h3/>";
			else
				echo "<h3/><span style='color:red;'>
				Error code:".$err."!</span><h3/>";
			return false;
		}
		return true;
	}
}

class Customer
{
	public $id;					//user id
	public $login;	
	public $pass;
	public $roleid;
	public $discount;		//customer's personal discount
	public $total;			//total ammount of purchases
	public $imagepath;	//path to the image
	
	function __construct($login,$pass,$imagepath,$id=0)
	{
		$this->login=$login;
		$this->pass =$pass;
		$this->imagepath =$imagepath;
		$this->id =$id;
		$this->total =0;
		$this->discount =0;
		$this->roleid =2;
	}
	function intoDb()
	{
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare("INSERT INTO Customers 
			(login,pass,roleid,discount,total,imagepath) 
			VALUES (:login,:pass,:roleid,:discount,:total,:imagepath)");
			$ar=(array)$this;
			array_shift($ar);
			$ps->execute($ar);
		}
		catch(PDOException $e) 
		{
				$err=$e->getMessage();
				if(substr($err,0,strrpos($err,":"))=='SQLSTATE[23000]: Integrity constraint violation')
					return 1062;
				else
					return $e->getMessage();
		}
	}

	static function fromDb($id)
	{
		$customer=null;
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare("SELECT * FROM Customers
			WHERE id=?");
			$res=$ps ->execute(array($id));
			$row=$res->fetch();
			$customer=new Customer($row['login'],
			$row['pass'], $row['imagepath'], $row['id']);
			return $customer;
		}
		catch(PDOException $e) 
		{
 				echo $e->getMessage();
 				return false;
		}
	}		
}

class Item
{
	public $id,$itemname,$catid,$pricein,$pricesale,$info,$rate,$imagepath,$action;
		
	function __construct($itemname,$catid,$pricein,$pricesale,$info,
		$imagepath,$rate=0,$action=0,$id=0)
	{
		$this->id=$id;
		$this->itemname=$itemname;
		$this->catid=$catid;
		$this->pricein=$pricein;
		$this->pricesale=$pricesale;
		$this->info=$info;
		$this->rate=$rate;
		$this->imagepath=$imagepath;
		$this->action=$action;
	}

	function intoDb()
	{
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare("INSERT INTO Items 
			(itemname,catid,pricein,pricesale,info,rate,imagepath,action) 
			VALUES (:itemname,:catid,:pricein,:pricesale,:info,:rate,:imagepath,:action)");
			$ar=(array)$this;
			array_shift($ar);
			$ps->execute($ar);
		}
		catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}

	static function fromDb($id)
	{
		$item=null;
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare("SELECT * FROM Items WHERE id=?");
			$ps->execute(array($id));
			$row=$ps->fetch();
			$item=new Item($row['itemname'], $row['catid'], $row['pricein'],
			$row['pricesale'], $row['info'], $row['imagepath'], 
			$row['rate'], $row['action'],$row['id']);
			return $item;
		}   
		catch(PDOException $e) 
		{
  			echo $e->getMessage();
  			return false;
		}
	}

	function Draw()
	{
		echo "<div class='col-sm-3 col-md-3 col-lg-3 container' style='height:320px;margin:0px;'>";
		//itemInfo.php contains detailed info about product
		echo "<div class='row' style='margin:2px;background-color:#ffd2aa;'>";
		echo "<a href='pages/itemInfo.php?name=".$this->id."' class='pull-left' style='margin-left:10px;'' target='_blank'>";
		echo $this->itemname;
		echo "</a>";
		echo "<span class='pull-right' style='margin-right:10px;'>";
		echo $this->rate."&nbsp;rate";
		echo "</span>";
		echo "</div>";
		echo "<div style='height:100px;margin:2px;' class='row'>";
		
		echo "<img src='".$this->imagepath."' height='100px' />";

		echo "<span class='pull-right' style='margin-left:10px;color:red;font-size:16pt;'>";
		echo "$&nbsp;".$this->pricesale;
		echo "</span>";

		echo "</div>";
		echo "<div class='row' style='margin:2px;'>";
		echo "<p class='text-left col-xs-12' style='background-color:lightblue;overflow:auto;height:60px;'>";
		echo $this->info;
		echo "</p>";
		echo "</div>";
		echo "<div class='row' style='margin-top:2px;'>";
		
		echo "</div>";
		echo "<div class='row' style='margin-top:2px;'>";
		$ruser='';
		if(!isset($_SESSION['reg']) || $_SESSION['reg'] =="")
		{
			$ruser="cart_".$this->id;
		}
		else
		{
			$ruser=$_SESSION['reg']."_".$this->id;
		}
		echo "<button class='btn btn-success col-xs-offset-1 col-xs-10' 
			onclick=createCookie('".$ruser."','".$this->id."')>Add To My Cart</button>";
		echo "</div>";
		echo "</div>";
	}

	function DrawForCart()
	{
		echo "<div class='row' style='margin:2px;'>";

		echo "<img src='".$this->imagepath."' width='70px' 
			class='col-sm-1 col-md-1 col-lg-1'/>";

		echo "<span style='margin-right:10px;background-color:#ddeeaa; color:blue;font-size:16pt' class='col-sm-3 col-md-3 col-lg-3'>";
		echo $this->itemname;
		echo "</span>";

		echo "<span style='margin-left:10px;color:red;font-size:16pt; background-color:#ddeeaa;' class='col-sm-2 col-md-2 col-lg-2' >";
		echo "$&nbsp;".$this->pricesale;
		echo "</span>";
		$ruser='';
		if(!isset($_SESSION['reg']) || $_SESSION['reg'] =="")
		{
			$ruser="cart_".$this->id;
		}
		else
		{
			$ruser=$_SESSION['reg']."_".$this->id;
		}
		echo "<button class='btn btn-sm btn-danger'
			style='margin-left:10px;' onclick=eraseCookie('".$ruser."')>x</button>";
				
		echo "</div>";
	}

	function Sale()
	{
		//echo 'Sale:'.$this->itemname.'<br/>';
		try{
			$pdo=Tools::connect();
			$ruser='cart';
			if(isset($_SESSION['reg']) && $_SESSION['reg'] !="")
			{
				$ruser=$_SESSION['reg'];
			}
			
			//Incresing total field for Customer
			$sql = "UPDATE Customers SET total=total + ? WHERE login = ?";
	    $ps = $pdo->prepare($sql);
	    $ps->execute(array($this->pricesale,$ruser));
	    //Inserting info about sold item into table Sales
	    $ins = "insert into Sales (customername,itemname,pricein,pricesale,datesale)
	    values(?,?,?,?,?)";
	    $ps = $pdo->prepare($ins);
	    //var_dump($ps);
	    $ps->execute(array($ruser,$this->itemname,$this->pricein,$this->pricesale,
	    	@date("Y/m/d H:i:s")));
	    //deleting item from Items table
	    $del = "DELETE FROM Items WHERE id = ?";
	    $ps = $pdo->prepare($del);
	    $ps->execute(array($this->id));
		}
		catch(PDOException $e) 
		{
  			echo $e->getMessage();
  			return false;
		}
	}

	static function GetItems($catid=0)
	{
		$ps=null;
		$items=null;
		try{
			$pdo=Tools::connect();
			if($catid == 0)
			{
				$ps=$pdo->prepare('select * from items');
				$ps->execute();
			}
			else
			{
				$ps=$pdo->prepare('select * from items where catid=?');
				$ps->execute(array($catid));
			}
			while ($row=$ps->fetch())
			{
				$item=new Item($row['itemname'], $row['catid'], $row['pricein'],
					$row['pricesale'], $row['info'], $row['imagepath'], 
					$row['rate'], $row['action'],$row['id']);
				$items[]=$item;
			}
			return $items;
		}
		catch(PDOException $e) 
		{
  			echo $e->getMessage();
  			return false;
		}
	}
}