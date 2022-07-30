<?php
namespace Game_of_life{
    class Cell {
        
        protected $alive;
        protected $changing;

        function __construct()
        {
            $this->alive=false;
            $this->changing=false;
        }
        
        
        public function getCellStatus()
        {
            return $this->alive;
        }
        public function getChanging()
        {
            return $this->changing;
        }

        public function changeStatus(){
            if ($this->alive==false) {
                $this->alive=true;
            }
            else{
                $this->alive=false;
            }
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

}

?>