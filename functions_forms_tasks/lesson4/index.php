<?php

function factorial($a){
    if ($a === 1) return $a;
    else return factorial($a - 1) * $a;
}

echo factorial(5);

die;
function sum2(...$vars){
    $sum = 0;
    foreach ($vars as $var){
        $sum += $var;
    }
    return $sum;
}

function sum1(){
    $sum = 0;
    $vars = func_get_args();
    foreach ($vars as $var){
        $sum += $var;
    }
    return $sum;
}

function sum($a, $b){
    return $a + $b;
}

function increase($var){
    //return $var++;
    return ++$var;
}

function increaseRef(&$var){
    $var++;
}


$var = 99;
increaseRef($var);
echo $var;
echo "<br>";

echo increase(10);
echo "<br>";

echo sum1(123, 436, 8);
echo "<br>";
echo sum2(123, 436, 8);
echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
echo 'Nick';
echo "<br>";
?>
</body>
</html>
