<?php

$monthesRus = array("Январь", "Феврать", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
$month = "Июль";

foreach ($monthesRus as $m){
    if($month == $m) echo "<b>$month</b><br>";
    else echo "$m<br>";
}
