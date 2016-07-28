<?php

$daysOfWeakRus = array("Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье");

foreach ($daysOfWeakRus as $m){
    if($m == "Суббота" || $m == "Воскресенье") echo "<b>$m</b><br>";
    else echo "$m<br>";
}