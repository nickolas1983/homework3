<?php
$myArray = array();

$size = 10;

for ($i = 0; $i < $size; $i++){
    array_push($myArray, rand(0,$size));
}
print_r ($myArray);
echo "<br>";

$temp = 0;
$max = 0;
$min = 0;
for ($i = 0; $i < $size; $i++){
    if ($myArray[$i] > $myArray[$max]) $max = $i;
    if ($myArray[$i] < $myArray[$min]) $min = $i;
}

$temp = $myArray[$max];
$myArray[$max] = $myArray[$min];
$myArray[$min] = $temp;

print_r ($myArray);