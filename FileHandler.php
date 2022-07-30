<?php
namespace Game_of_life{
    class FileHandler{

    //The number of rows and colums 
    public static $rowandcol;

    //The amount of cells required for survival
    public static $livingArray;

    //The amount of cells required for revival
    public static $reviveArray;

    //The coordinates of the living cells
    public static $livingCellCoords;

    static function init()
    {
        $config=file_get_contents("./files/config.txt",true);

        self::$rowandcol=preg_split("/[\s,]+/",$config);

        self::$livingCellCoords=array();

        $life=file_get_contents("./files/life.lif",true);

        $rules=preg_split("/(\r\n|\n|\r)/",$life);

        $numOfLines=count($rules);

        if ($rules[0]=="#Life 1.05") {
                $i=1;
                while ($i<$numOfLines && substr($rules[$i],0,2)=="#D") {
                    $i++;
                }
                if (substr($rules[$i],0,2)=="#N") {
                    self::$livingArray=array(2,3);
                    self::$reviveArray=array(3);
                }
                else{
                    $ruleString=preg_split("/\//",substr($rules[$i],3));
                    self::$livingArray=str_split($ruleString[0]);
                    self::$reviveArray=str_split($ruleString[1]);
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
                            array_push(self::$livingCellCoords,array($x_coord+$lineSince_P,$y_coord+$j));
                        }
                        $j++;
                    }
                    
                    $i++;
                    $lineSince_P--;

                }
                

            }
        }
        
    }

    FileHandler::init();
}
?>