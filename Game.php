<?php
require 'Area.php';
require 'Cell.php';

$map=new Area(4,4);

$map->addItem(-2,4,new Cell());



$item=$map->getItem(6,4);



var_dump($item);

?>