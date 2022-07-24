<?php
require 'Area.php';
require 'Cell.php';


///////////         FILL UP THE AREA          /////////////
class Game 
{
    public $map;
    public $dyingRule=array(1,4,5,6,7);
    public $reviveRule=array(3);
    function __construct()
    {
        $this->map=new Area(4,4);
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


//TODO  
// SET UP THE RULES, NEXT GENERATION


    //CSAK TESZTELÉSRE!!!
    function setToAlive(int $row,int $col){
        $this->map->getItem($row,$col)->setToAlive();
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
        if (in_array($this->checkArea($row,$col),$this->dyingRule)) {
            $this->map->getItem($row,$col)->setToDead();
        }
        elseif (in_array($this->checkArea($row,$col),$this->reviveRule)) {
            $this->map->getItem($row,$col)->setToAlive();
        }
    }

}

$game=new Game();
$game->setToAlive(2,4);
$game->setToAlive(3,4);
$game->setToAlive(4,4);
$game->setToAlive(3,5);

var_dump($game->checkArea(3,5));
?>