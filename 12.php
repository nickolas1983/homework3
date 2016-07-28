<?php

$n = 1000;
$num = 0;
while ($n >= 50) {
    $n /= 2;
    $num++;
}

echo "Результат: (1000 / 2) * $num = $n";