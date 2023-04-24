<?php
class Point
{
	public $x;
  	public $y;
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
$jspoint=json_encode($p);
echo $jspoint.'<br/>';
file_put_contents('jsonpoint.txt',$jspoint);

?>