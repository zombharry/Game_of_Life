<?php
require 'Cell.php';

/*
$test=new Cell();

$test->setToAlive();
var_dump($test->getCellStatus());

*/

/*
$area=array();
for ($i=$row; $i <=($row*(-1)); $i++) { 
    $area[$i]=array();
    for ($j=$col; $j <=($col*(-1)); $j++) { 
        $area[$i][$j]=new Cell();
    }
    $area[$i][-26]=&$area[$i][25];
    $area[$i][26]=&$area[$i][-25];
}

$area[12][25]->setToAlive();

*/

class Area
{
   protected $row;
   protected $col;
   private $area;

   function __construct(int $row,int $col)
   {
    
    $negativerow=$row*(-1);
    $negativecol=$col*(-1);

    $this->area=array();
    for ($i=$negativerow; $i <=$row; $i++) 
    { 
        $this->area[$i]=array();
        for ($j=$negativecol; $j <=$negativecol; $j++) { 
            $this->area[$i][$j]=null;
        }
    }

    $this->row=$row;
    $this->col=$col;
    
   }

   function getItem(int $row,int $col)
   {
    if ($row>$this->$row) {
        $row=($row%($this->row))-$row;
    }
    else
    {
        $row=$row%($this->row);
    }

    if ($col>$this->$col) {
        $col=($col%($this->col))-$col;
    }
    else
    {
        $col=$col%($this->col);
    }
    
    return $this->area[$row][$col];
   }
   function addItem(int $row,int $col,$item)
   {
    $this->area[$row][$col]=$item;
   }

   function removeItem(int $row,int $col)
   {
    $this->area[$row][$col]=null;
   }

}



var_dump(27%25);
?>