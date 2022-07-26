<?php
require 'Area.php';
require 'Cell.php';


///////////         FILL UP THE AREA          /////////////
class Game 
{
    public $map;
    public $livingRule;
    public $reviveRule;
    function __construct(int $rownum,int $colnum, array $livingArray,array $revivingArray)
    {
        $this->map=new Area($rownum,$colnum);
        $this->livingRule=$livingArray;
        $this->reviveRule=$revivingArray;
        $negativerow=$this->map->getRowNum()*(-1);
        $negativecol=$this->map->getColNum()*(-1);

        
        for ($i=$negativerow; $i <=$this->map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=$this->map->getColNum(); $j++) { 
                $this->map->addItem($i,$j,new Cell());
            }
        }
    }



///////////////////////////////////////////////////////




    function checkThreeInRow(int $row,int $col)
    {
        $numberOfLiving=0;
        for ($i=0; $i < 3; $i++) { 
            if ($this->map->getItem($row,$col)->getCellStatus()) {
                $numberOfLiving++;
            }
            $col++;
        }

        return $numberOfLiving;
    }

    function checkHorizontalNeighbours(int $row,int $col)
    {
        $col--;
        $numberOfLiving=0;
        for ($i=0; $i < 2; $i++) { 
            if ($this->map->getItem($row,$col)->getCellStatus()) {
                $numberOfLiving++;
            }
            $col=$col+2;
        }
        return $numberOfLiving;
    }

    function checkArea(int $row,int $col){
        $numberOfLiving=0;
        $numberOfLiving=$numberOfLiving+$this->checkHorizontalNeighbours($row,$col);
        $numberOfLiving=$numberOfLiving+$this->checkThreeInRow($row+1,$col-1);
        $numberOfLiving=$numberOfLiving+$this->checkThreeInRow($row-1,$col-1);
        
        return $numberOfLiving;
    }

    function ruleCheck(int $row,int $col){
        if ($this->map->getItem($row,$col)->getCellStatus()==true &&
            !(in_array($this->checkArea($row,$col),$this->livingRule))) {
            $this->map->getItem($row,$col)->changeChanging();
        }
        elseif ($this->map->getItem($row,$col)->getCellStatus()==false &&
            in_array($this->checkArea($row,$col),$this->reviveRule)) {
            $this->map->getItem($row,$col)->changeChanging();
        }
    }
    function endRound()
    {
        $negativerow=$this->map->getRowNum()*(-1);
        $negativecol=$this->map->getColNum()*(-1);

        for ($i=$negativerow; $i <=$this->map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=$this->map->getColNum(); $j++) { 
                if ($this->map->getItem($i,$j)->getChanging()) {

                    $this->map->getItem($i,$j)->changeStatus();
                }
            }
        }
    }


}

?>