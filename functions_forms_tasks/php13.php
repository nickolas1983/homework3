<?php
function returnUniqeWords($str){
    $pattern = "/\w+/u";

    preg_match_all($pattern, $str, $array);

    $array = array_count_values($array[0]);

    foreach ($array as $key => $value){
        echo "{$key} - $value <br>";
    }
}


$str = 'яблоко черешня вишня вишня черешня груша яблоко черешня вишня яблоко вишня вишня черешня груша яблоко черешня черешня вишня яблоко вишня вишня черешня вишня черешня груша яблоко черешня черешня вишня яблоко вишня вишня черешня черешня груша яблоко черешня вишня';
echo "$str <br> <br>";

returnUniqeWords($str)
?>


