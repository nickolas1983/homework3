<?php



$array = glob('images/*.*');

echo '<pre>';
var_dump($array);
echo '</pre>';

foreach ($array as $fileName) {
    //echo mb_convert_encoding($fileName, 'Windows-1251', 'UTF-8');
    echo iconv('Windows-1251', 'UTF-8', $fileName);
    echo '<br>';
}

echo '<pre>';
var_dump($array);
echo '</pre>';