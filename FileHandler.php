<?php

class FileHandler{

//The number of rows and colums 
public $rowandcol;

//The amount of cells required for survival
public $livingArray;

//The amount of cells required for revival
public $reviveArray;

//The coordinates of the living cells
public $livingCellCoords;

function __construct(string $filepath)
{
    $config=file_get_contents("./files/config.txt",true);

    $this->rowandcol=preg_split("/[\s,]+/",$config);

    $this->livingCellCoords=array();

    $life=file_get_contents($filepath,true);

    $rules=preg_split("/(\r\n|\n|\r)/",$life);

    $numOfLines=count($rules);

    if ($rules[0]=="#Life 1.05") {
            $i=1;
            while ($i<$numOfLines && substr($rules[$i],0,2)=="#D") {
                $i++;
            }
            if (substr($rules[$i],0,2)=="#N") {
                $this->livingArray=array(2,3);
                $this->reviveArray=array(3);
            }
            else{
                $ruleString=preg_split("/\//",substr($rules[$i],3));
                $this->livingArray=str_split($ruleString[0]);
                $this->reviveArray=str_split($ruleString[1]);
            }
            $i++;
            $coords=preg_split("/[\s,]+/",$rules[$i]);
            $x_coord=$coords[1];
            $y_coord=$coords[2];
            $lineSince_P=0;
            $i++;
            while($i<$numOfLines)
            {
                
                $line=str_split($rules[$i],1);
                $lineLength=count($line);
                $j=0;
                while ($j < $lineLength) {
                    if ($line[$j]=='*') {
                        array_push($this->livingCellCoords,array($x_coord+$lineSince_P,$y_coord+$j));
                    }
                    $j++;
                }
                
                $i++;
                $lineSince_P--;

            }
            

        }
    }
}

?>