<?php
require 'Game.php';



if (isset($_GET['rownum'])) {
    Game::nextRound();
    echo display($_GET['rownum'],$_GET['colnum'],Game::getLivingCoords());
    
    //display();
}

/*
function display()
{
    echo json_encode(Game::getLivingCoords());
    echo "<input type='hidden' id='rownum' value=".Game::$map->getRowNum().">";
    echo "<input type='hidden' id='colnum' value=".Game::$map->getColNum().">";

}
*/

function display($rownum,$colnum,array $coords)
{
    
    $display_string="<table class='mytable'>";

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

$display_string=$display_string."<input type='hidden' id='rownum' value=".$rownum.">";
$display_string=$display_string."<input type='hidden' id='colnum' value=".$colnum.">";


return $display_string;
}


?>