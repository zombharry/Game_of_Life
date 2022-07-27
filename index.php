<?php
require 'Game.php';
require 'FileHandler.php';

$fh=new FileHandler("./files/test.lif");


$game=new Game($fh->rowandcol[0],$fh->rowandcol[1],$fh->livingArray,$fh->reviveArray,$fh->livingCellCoords);


require 'header.partial.php'; 


for ($i=$game->map->getRowNum(); $i >=(-1)*($game->map->getRowNum()); $i--) { 
    echo '<tr>';
    for ($j=(-1)*($game->map->getColNum()); $j <=$game->map->getColNum(); $j++)
    {
        if (in_array(array($i,$j),$game->getLivingCoords())) {
            echo "<td class='colored'>$i $j</td>";
        }
        else
        {
            echo "<td>$i $j</td>";
        }
        
    }
    echo '</tr>';
}


require 'footer.partial.php';
?>
