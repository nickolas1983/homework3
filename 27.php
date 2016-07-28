<?php

$row = 5;
$cols = 5;
$colors = array('red','yellow','blue','gray','maroon','brown','green');

echo "<table border = '1'>";
for ($i = 0; $i < $row; $i++){
    echo "<tr>";
    for($j = 0; $j < 5; $j++){
        $color = $colors[rand(0, count($colors) - 1)];
        $rand = rand(10000, 99999);
        echo "<td bgcolor = $color> $rand </td>";
    }
    echo "</tr>";
}
echo "</table>";


