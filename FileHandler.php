<?php

$config=file_get_contents("./files/config.txt",true);

$rowandcol=preg_split("/[\s,]+/",$config);
//var_dump($rowandcol);



$livingArray;
$reviveArray;
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
    var_dump($livingArray);
}
?>