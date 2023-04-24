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
$strpoint=file_get_contents('point.txt');
echo $strpoint.'<br/>';
$p=unserialize($strpoint);
$p->Show();


?>