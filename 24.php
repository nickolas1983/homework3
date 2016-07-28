<?php

$haysteck = '12312345465467';
$needle = 4;
$count = 0;
for ($i = 0; $i < strlen($haysteck); $i++){
    if ($needle == $haysteck[$i]) $count++;
}

echo "Цыфра $needle в числе $haysteck встречается $count раз.";