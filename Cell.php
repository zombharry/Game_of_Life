<?php

class Cell {
    
    protected $alive;
    protected $changing;

    function __construct()
    {
        $this->alive=false;
        $this->changing=false;
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
    public function getChanging()
    {
        return $this->alive;
    }
    public function changeChanging()
    {
        if ($this->changing==false) {
            $this->changing=true;
        }
        else{
            $this->changing=false;
        }
    }



}



?>