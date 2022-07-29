<?php
require_once 'Game.php';


if(isset($_GET['ajax']) && $_GET['ajax']=='ajax'){

    Game::nextRound();
    echo display(Game::$map->getRowNum(),Game::$map->getColNum(),Game::getLivingCoords());
 
    
}



function display($rownum,$colnum,array $coords)
{
    
    
    $display_string="<table id='mytable'>";

    for ($i=$rownum; $i >=(-1)*($rownum); $i--) { 
        $display_string=$display_string.'<tr>';
        for ($j=(-1)*($colnum); $j <=$colnum; $j++)
        {
            if (in_array(array($i,$j),$coords)) {
                $display_string=$display_string. "<td class='colored'>$i $j</td>";
            }
            else
            {
                $display_string=$display_string. "<td>$i $j</td>";
            }
            
        }
        $display_string=$display_string. '</tr>';
    }
    $display_string=$display_string. "</table>";


    return $display_string;
}


?>