<?php
class Rectangle
{
	public $top;
  	public $left;
  	public $width;
	public $height;
	function __construct($t, $l, $w, $h)
	{
		$this->top=$t;
		$this->left=$l;
		$this->width=$w;
		$this->height=$h;
	}
	function Show()
	{
		echo 'Vertex: ('.$this->top.','.$this->left.') width:'.
			$this->width.' height:'.$this->height.'<br/>';
	}
}
$r=new Rectangle(100,200,200,150);
$r->Show();
var_dump($r);
?>

