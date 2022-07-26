<?php
namespace Game_of_life{

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
    //$j=$negativecol; $j <=$negativecol; $j++
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
        if ($gotValue>$original && $gotValue%$original!=0) {
            $gotValue=($gotValue%($original))-$original-1;
        }
        else{
            $gotValue=$gotValue%($original+1);
        }
    }
    else{
        $gotValue=$gotValue*(-1);
        if ($gotValue>$original && $gotValue%$original!=0) {
            $gotValue=(-1)*(($gotValue%($original))-$original-1);
        }
        else{
            $gotValue=(-1)*($gotValue%($original+1));
        }
    }
    
    return $gotValue;

   }

}
}
?>