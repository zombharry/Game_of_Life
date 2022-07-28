<?php

require 'display.php';

require 'header.partial.php'; 

echo display(Game::$map->getRowNum(),Game::$map->getColNum(),Game::getLivingCoords());
//display();

require 'footer.partial.php';
?>
