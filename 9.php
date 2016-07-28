<?php
$arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
$str = '';
foreach ($arr as $value) {
    $str .= $value;
}

echo $str.'<br>';

$str = '';
for ($i = 0; $i < count($arr); $i++){
    $str .= $arr[$i];
}

echo $str.'<br>';

$str = '';
$i = 0;
while ($i < count($arr)){
    $str .= $arr[$i];
    $i++;
}

echo $str.'<br>';