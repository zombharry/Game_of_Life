<?php

require 'display.php';

require 'header.partial.php'; 

echo '<div name="display_table" id="display_table">';

echo display(Game::$map->getRowNum(),Game::$map->getColNum(),Game::getLivingCoords());


echo "</div>";
require 'footer.partial.php';


?>
