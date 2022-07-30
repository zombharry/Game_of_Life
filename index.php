<?php
namespace Game_of_life{

require 'display.php';

require 'header.partial.php'; 

require_once 'Game.php';

$game=new Game();



echo '<div id="display_table">';


echo display($game->getLivingCoords());


//display();
echo "</div>";
require 'footer.partial.php';
}
?>
