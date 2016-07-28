<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задачи по массивам и циклам</title>
</head>
<body>
<form action="23.php" method="get">
    <p>Введите целое число</p>
    <input type="text" name="number"><br><br>
    <input type="submit" name="OK" value="OK">
</form><br>

<?php
if (isset($_GET)){
    $myArray = array();
    $myArray = $_GET;
    $numb = ''.$myArray["number"];
    $sum = 0;
    for ($i =0; $i < strlen($numb); $i++){
        $sum += $numb[$i];
    }
    echo 'Сумма цифр числа '.$numb.' = '.$sum.'<br>';
}

?>

</body>
</html>


