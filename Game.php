<?php
require 'Area.php';
require 'Cell.php';



///////////         FILL UP THE AREA          /////////////
class Game 
{
    public $map;
    //Rules for the survival
    public $livingRule;
    //Rules for the revival
    public $reviveRule;

    public $generation;
    function __construct(int $rownum,int $colnum, array $livingArray,array $revivingArray,array $livingCellCoords)
    {
        $this->generation=0;
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

        for ($i=0; $i < count($livingCellCoords); $i++) { 
            $this->map->getItem($livingCellCoords[$i][0],$livingCellCoords[$i][1])->changeStatus();
        }

    }



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

    //Return the number of living cells in the same row
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

    //return the number of living neighbours around the cell
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

    function scan()
    {
        $negativerow=$this->map->getRowNum()*(-1);
        $negativecol=$this->map->getColNum()*(-1);

        for ($i=$negativerow; $i <=$this->map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=$this->map->getColNum(); $j++) { 
                $this->ruleCheck($i,$j);
            }
        }
    }

    //return a multidimensional array with the coordinates of the living
    function getLivingCoords()
    {
        $negativerow=$this->map->getRowNum()*(-1);
        $negativecol=$this->map->getColNum()*(-1);
        $livingCellCoords=array();

        for ($i=$negativerow; $i <=$this->map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=$this->map->getColNum(); $j++) { 
                if ($this->map->getItem($i,$j)->getCellStatus()) {

                    array_push($livingCellCoords,array($i,$j));
                }
            }
        }
        return $livingCellCoords;
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
                    $this->map->getItem($i,$j)->changeChanging();
                }
            }
        }
    }
    function nextRound()
    {
        $this->scan();
        $this->endRound();
        $this->generation++;

    }
    


}

?>