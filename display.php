<?php
namespace Game_of_life{

require_once 'Game.php';



if (isset($_GET['ajax'])) {
    
    $game=new Game();

    $game->setLivingCoords(json_decode($_GET['coords']));

    echo display(json_decode($_GET['coords']));
    

}



function display(array $coords)
{
    $game=new Game();

    $rownum=$game->getRowNum();
    $colnum=$game->getColNum();
    $game->setLivingCoords($coords);
    
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
    $game->nextRound();
    $display_string=$display_string. "<input type='hidden' id='coords' value=".json_encode($game->getLivingCoords()).">";

    return $display_string;
}
    


/*
function display()
{
    echo json_encode(Game::getLivingCoords());
    echo "<input type='hidden' id='rownum' value=".Game::$map->getRowNum().">";
    echo "<input type='hidden' id='colnum' value=".Game::$map->getColNum().">";

}
*/

}
?>