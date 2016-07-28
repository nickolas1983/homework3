<?php
$myArray = array();

$size = 100;
$mult = 1;


for ($i = 0; $i < $size; $i++){
    array_push($myArray, rand(1,$size));
    if ($i % 2 == 0) $mult *= $myArray[$i];
    else echo $myArray[$i].'<br>';
}