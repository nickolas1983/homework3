<?php

$row = 10;
$cols = 10;
$colors = array('black','yellow');

echo "<table border = '1'>";
for ($i = 0; $i < $row; $i++){
    echo "<tr>";
    for($j = 0; $j < $cols; $j++){
        if ($j + $i == 9) echo "<td bgcolor = $colors[0] style=\"width: 20px;\"> </td>";
        else echo "<td bgcolor = $colors[1] style=\"width: 30px; height: 30px\"> </td>";
    }
    echo "</tr>";
}
echo "</table><br>";


$row = 10;
$cols = 10;
$colors = array('black','yellow');

echo "<table border = '1'>";
for ($i = 0; $i < $row; $i++){
    echo "<tr>";
    for($j = 0; $j < $cols; $j++){
        if ($j == $i) echo "<td bgcolor = $colors[0] style=\"width: 20px;\"> </td>";
        else echo "<td bgcolor = $colors[1] style=\"width: 30px; height: 30px\"> </td>";
    }
    echo "</tr>";
}
echo "</table><br>";


$row = 10;
$cols = 10;
$colors = array('black','yellow');

echo "<table border = '1'>";
for ($i = 0; $i < $row; $i++){
    echo "<tr>";
    for($j = 0; $j < $cols; $j++){
        if (($j + $i) % 2 == 0) echo "<td bgcolor = $colors[0] style=\"width: 20px;\"> </td>";
        else echo "<td bgcolor = $colors[1] style=\"width: 30px; height: 30px\"> </td>";
    }
    echo "</tr>";
}
echo "</table>";