<?php
class Point
{
	private $x;
  	private $y;
	function __construct($x, $y)
	{
		$this->x=$x;
		$this->y=$y;
	}
	function Show()
	{
		echo 'Vertex: ('.$this->x.','.$this->y.') <br/>';
	}
}
$p=new Point (100,200);
$p->Show();
$strpoint=serialize($p);
echo $strpoint;
file_put_contents('point.txt',$strpoint);
?>