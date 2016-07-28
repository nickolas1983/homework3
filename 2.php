<?php
$myArray = array(1, 20, 15, 17, 24, 35);
$result = 0;
foreach ($myArray as $value) {
    $result += $value;
}
echo $result;