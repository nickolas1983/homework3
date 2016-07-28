<?php

$daysOfWeakRus = array("Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");
$day = "Четверг";

foreach ($daysOfWeakRus as $m){
    if($m == $day) echo "<i>$m</i><br>";
    else echo "$m<br>";
}