<?php
$arr = array(4, 2, 5, 19, 13, 0, 10);
$e = array(2, 3, 4);

foreach ($e as $item) {

    $flag = 0;
    foreach ($arr as $value) {
        if ($item == $value) $flag = 1;
    }

    if ($flag == 1) echo "Есть!<br>";
    else echo "Нет!<br>";
}


