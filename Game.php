<?php
namespace Game_of_life{
    require 'Area.php';
    require 'Cell.php';
    require 'FileHandler.php';
    



    ///////////         FILL UP THE AREA          /////////////
    class Game
    {


        public  $map;
        //Rules for the survival
        protected  $livingRule;
        //Rules for the revival
        protected  $reviveRule;

        protected $livingCoords;

        public  $gen;

        function __construct()
        {
            $this->gen=0;
            $this->map=new Area(FileHandler::$rowandcol[0],FileHandler::$rowandcol[1]);
       
            $this->livingRule=FileHandler::$livingArray;
            $this->reviveRule=FileHandler::$reviveArray;
            $negativerow= $this->map->getRowNum()*(-1);
            $negativecol= $this->map->getColNum()*(-1);

             //Create the map
            for ($i=$negativerow; $i <= $this->map->getRowNum(); $i++) 
            { 
                for ($j=$negativecol; $j <= $this->map->getColNum(); $j++) { 
                    $this->map->addItem($i,$j,new Cell());
                    
                }
            }
            
           //Change the status of the cells
            for ($i=0; $i < count(FileHandler::$livingCellCoords); $i++) { 
                $this->map->getItem(FileHandler::$livingCellCoords[$i][0],FileHandler::$livingCellCoords[$i][1])->changeStatus();
            }


            //get the living cells' coordinates from the map
            
            $this->livingCoords=$this->getLivingFromMap();
        }
        
        public function setLivingCoords(array $coords)
        {
            $negativerow= $this->map->getRowNum()*(-1);
            $negativecol= $this->map->getColNum()*(-1);

            // set all cells' status to dead
            for ($i=$negativerow; $i <= $this->map->getRowNum(); $i++) 
            { 
                for ($j=$negativecol; $j <= $this->map->getColNum(); $j++) { 
                    if ($this->map->getItem($i,$j)->getCellStatus()) {
                        $this->map->getItem($i,$j)->changeStatus();
                    }
                    
                    
                }
            }

            //Set the selected cells' status to alive
            $row=count($coords);
            for ($i=0; $i <$row ; $i++) { 
                if ($this->map->getItem($coords[$i][0],$coords[$i][1])->getCellStatus()==false) {
                    $this->map->getItem($coords[$i][0],$coords[$i][1])->changeStatus();
                }
                
            }

            $this->livingCoords=$coords;
        }

        //get the living cells' coordinates from the map
        private function getLivingFromMap()
        {
            $negativerow= $this->map->getRowNum()*(-1);
            $negativecol= $this->map->getColNum()*(-1);
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


        public function getRowNum()
        {
            return $this->map->getRowNum();
        }

        public function getColNum()
        {
            return $this->map->getColNum();
        }

        private function checkThreeInRow(int $row,int $col)
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
        private function checkHorizontalNeighbours(int $row,int $col)
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
        private function checkArea(int $row,int $col){
            $numberOfLiving=0;
            $numberOfLiving=$numberOfLiving+$this->checkHorizontalNeighbours($row,$col);
            $numberOfLiving=$numberOfLiving+$this->checkThreeInRow($row+1,$col-1);
            $numberOfLiving=$numberOfLiving+$this->checkThreeInRow($row-1,$col-1);
            
            return $numberOfLiving;
        }

        private function ruleCheck(int $row,int $col){
            if ($this->map->getItem($row,$col)->getCellStatus()==true &&
                !(in_array($this->checkArea($row,$col),$this->livingRule))) {
                    $this->map->getItem($row,$col)->changeChanging();
            }
            elseif ($this->map->getItem($row,$col)->getCellStatus()==false &&
                in_array($this->checkArea($row,$col),$this->reviveRule)) {
                    $this->map->getItem($row,$col)->changeChanging();
            }
        }

        private function scan()
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
        public function getLivingCoords()
        {
            
            return $this->livingCoords;
        }

        private function endRound()
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
            
            $this->livingCoords=$this->getLivingFromMap();


        }
         function nextRound()
        {
            $this->scan();
            $this->endRound();
        }
        


    }

}
?>