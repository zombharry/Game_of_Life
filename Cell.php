<?php

class Cell {
    
    protected $alive;

    function __construct()
    {
        $this->alive=false;
    }

    public function setToDead()
    {
        $this->alive=false;
    }
    public function setToAlive()
    {
        $this->alive=true;
    }
    public function getCellStatus()
    {
        return $this->alive;
    }


}



?>