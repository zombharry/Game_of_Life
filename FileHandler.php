<?php

$config=file_get_contents("./files/config.txt",true);

$rowandcol=preg_split("/[\s,]+/",$config);
//var_dump($rowandcol);



$livingArray;
$reviveArray;
$livingCellCoords=array();
$life=file_get_contents("./files/test.lif",true);

$rules=preg_split("/(\r\n|\n|\r)/",$life);
//var_dump($rules);
$numOfLines=count($rules);

if ($rules[0]=="#Life 1.05") {
    $i=1;
    while ($i<$numOfLines && substr($rules[$i],0,2)=="#D") {
        $i++;
    }
    if (substr($rules[$i],0,2)=="#N") {
        $livingArray=array(2,3);
        $reviveArray=array(3);
    }
    else{
        $ruleString=preg_split("/\//",substr($rules[$i],3));
        $livingArray=str_split($ruleString[0]);
        $reviveArray=str_split($ruleString[1]);
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
        if ($line[$j]=='*') {
            array_push($livingCellCoords,array($x_coord+$lineSince_P,$y_coord+$j));
        }
        $i++;
        $lineSince_P++;

    }
    

    var_dump(str_split($rules[5],1));

}
?>