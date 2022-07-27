<?php
require 'Game.php';
require 'FileHandler.php';

$fh=new FileHandler("./files/test.lif");


$game=new Game($fh->rowandcol[0],$fh->rowandcol[1],$fh->livingArray,$fh->reviveArray,$fh->livingCellCoords);

//var_dump($game);

require 'header.partial.php'; 

for ($i=0; $i <$game->map->getRowNum(); $i++) { 
    echo '<tr>';
    for ($j=0; $j <$game->map->getColNum(); $j++)
    {
        echo "<td></td>";
    }
    echo '</tr>';
}


require 'footer.partial.php';
?>
