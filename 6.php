<?php
$arr = array('green'=>'зеленый', 'red'=>'красный','blue'=>'голубой');
$en = array();
$ru = array();
foreach ($arr as $key => $value) {
    array_push($en, $key);
    array_push($ru, $value);
}

echo '<pre>';
print_r ($en);
echo '</pre>';

echo '<pre>';
print_r ($ru);
echo '</pre>';