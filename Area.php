<?php

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
    $row=$this->overlap($this->row,$row);

    $col=$this->overlap($this->col,$col);
    
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

   function getRowNum()
   {
    return $this->row;
   }
   function getColNum()
   {
    return $this->col;
   }
   
   
   
   private function overlap($original,$gotValue)
   {
    if ($gotValue>=0) {
        if ($gotValue>$original) {
            $gotValue=($gotValue%($original))-$original-1;
        }
        else{
            $gotValue=$gotValue%($original+1);
        }
    }
    else{
        $gotValue=$gotValue*(-1);
        if ($gotValue>$original) {
            $gotValue=(-1)*(($gotValue%($original))-$original-1);
        }
        else{
            $gotValue=$gotValue%($original+1);
        }
    }
    
    return $gotValue;

   }

}

?>