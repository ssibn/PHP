<?php
// Trait
trait Collect{
  public function Add(&$arr)
  {
  		if(!$this instanceOf Geometry) return false;
    	$arr[]=$this;
  } 
}

interface Geometry
{
	const Pi=3.1415926;
	function Area();
	function Perimeter();
}

class Point
{
	use Collect;
	protected $x;
  protected $y;
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


class Rectangle extends Point implements Geometry
{
	use Collect;
  protected $width;
	protected $height;
	function __construct($x, $y, $w, $h)
	{
		parent::__construct($x, $y);
		$this->width=$w;
		$this->height=$h;
	}
	function Show()
	{
		echo 'Vertex: ('.$this->x.','.$this->y.') width:'.
			$this->width.' height:'.$this->height.'<br/>';
	}
	function Area()
	{
		return $this->width * $this->height;
	}
	function Perimeter()
	{
		return ($this->width + $this->height)*2;
	}

}

class Circle extends Point implements Geometry
{
	use Collect;
  	protected $redius;
	function __construct($x, $y, $r)
	{
		parent::__construct($x, $y);
		$this->radius=$r;
	}
	function Show()
	{
		echo 'Vertex: ('.$this->x.','.$this->y.') radius:'.
		$this->radius.'<br/>';
	}
	function Area()
	{
		return $this->radius * $this->radius * Geometry::Pi;
	}
	function Perimeter()
	{
		return $this->radius * Geometry::Pi * 2;
	}

}
$figures=array();
$o1=new Rectangle(100,200, 100,100);
$o2=new Circle(200,200, 100);
$o3=new Point(100,100);
$o4=new Circle(300,200, 100);
$o1->Add($figures);
$o2->Add($figures);
$o3->Add($figures);
$o4->Add($figures);

$totalArea=0;
$totalPerimeter=0;
foreach($figures as $f)
{
	$totalArea += $f->Area();
	$totalPerimeter +=$f->Perimeter();
}
echo 'Total area is:'. $totalArea. '<br/>';
echo 'Total perimeter is:'. $totalPerimeter. '<br/>';

?>

