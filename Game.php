<?php
require 'Area.php';
require 'Cell.php';
require 'FileHandler.php';



///////////         FILL UP THE AREA          /////////////
class Game
{


    public static $map;
    //Rules for the survival
    public static $livingRule;
    //Rules for the revival
    public static $reviveRule;

    public static $gen;

    static function init()
    {

        self::$gen=0;
        self::$map=new Area(FileHandler::$rowandcol[0],FileHandler::$rowandcol[1]);
    
        self::$livingRule=FileHandler::$livingArray;
        self::$reviveRule=FileHandler::$reviveArray;
        $negativerow= self::$map->getRowNum()*(-1);
        $negativecol= self::$map->getColNum()*(-1);

        
        for ($i=$negativerow; $i <= self::$map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <= self::$map->getColNum(); $j++) { 
                self::$map->addItem($i,$j,new Cell());
                
            }
        }

        for ($i=0; $i < count(FileHandler::$livingCellCoords); $i++) { 
            self::$map->getItem(FileHandler::$livingCellCoords[$i][0],FileHandler::$livingCellCoords[$i][1])->changeStatus();
        }

    }



    private static function checkThreeInRow(int $row,int $col)
    {
        $numberOfLiving=0;
        for ($i=0; $i < 3; $i++) { 
            if (self::$map->getItem($row,$col)->getCellStatus()) {
                $numberOfLiving++;
            }
            $col++;
        }

        return $numberOfLiving;
    }

    //Return the number of living cells in the same row
    private static function checkHorizontalNeighbours(int $row,int $col)
    {
        $col--;
        $numberOfLiving=0;
        for ($i=0; $i < 2; $i++) { 
            if (self::$map->getItem($row,$col)->getCellStatus()) {
                $numberOfLiving++;
            }
            $col=$col+2;
        }
        return $numberOfLiving;
    }

    //return the number of living neighbours around the cell
    private static function checkArea(int $row,int $col){
        $numberOfLiving=0;
        $numberOfLiving=$numberOfLiving+self::checkHorizontalNeighbours($row,$col);
        $numberOfLiving=$numberOfLiving+self::checkThreeInRow($row+1,$col-1);
        $numberOfLiving=$numberOfLiving+self::checkThreeInRow($row-1,$col-1);
        
        return $numberOfLiving;
    }

    private static function ruleCheck(int $row,int $col){
        if (self::$map->getItem($row,$col)->getCellStatus()==true &&
            !(in_array(self::checkArea($row,$col),self::$livingRule))) {
                self::$map->getItem($row,$col)->changeChanging();
        }
        elseif (self::$map->getItem($row,$col)->getCellStatus()==false &&
            in_array(self::checkArea($row,$col),self::$reviveRule)) {
                self::$map->getItem($row,$col)->changeChanging();
        }
    }

    private static function scan()
    {
        $negativerow=self::$map->getRowNum()*(-1);
        $negativecol=self::$map->getColNum()*(-1);

        for ($i=$negativerow; $i <=self::$map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=self::$map->getColNum(); $j++) { 
                self::ruleCheck($i,$j);
            }
        }
    }

    //return a multidimensional array with the coordinates of the living
    static function getLivingCoords()
    {
        $negativerow=self::$map->getRowNum()*(-1);
        $negativecol=self::$map->getColNum()*(-1);
        $livingCellCoords=array();

        for ($i=$negativerow; $i <=self::$map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=self::$map->getColNum(); $j++) { 
                if (self::$map->getItem($i,$j)->getCellStatus()) {

                    array_push($livingCellCoords,array($i,$j));
                }
            }
        }
        return $livingCellCoords;
    }

    private static function endRound()
    {
        $negativerow=self::$map->getRowNum()*(-1);
        $negativecol=self::$map->getColNum()*(-1);

        for ($i=$negativerow; $i <=self::$map->getRowNum(); $i++) 
        { 
            for ($j=$negativecol; $j <=self::$map->getColNum(); $j++) { 
                if (self::$map->getItem($i,$j)->getChanging()) {

                    self::$map->getItem($i,$j)->changeStatus();
                    self::$map->getItem($i,$j)->changeChanging();
                }
            }
        }
    }
    static function nextRound()
    {
        self::scan();
        self::endRound();
    }
    


}

Game::init();

?>