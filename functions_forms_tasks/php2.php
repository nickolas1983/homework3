<?php

/* Search fo common words in 2 strings */
function getCommonWords($a, $b){
    $tArr1 = explode(" ", $a);
    $tArr2 = explode(" ", $b);
    $result = array_intersect($tArr1, $tArr2);
    $result = array_unique($result);
    return $result;
}


function cmp($a, $b)
{
    if (strlen($a) == strlen($b)) {
        return 0;
    }
    return (strlen($a) < strlen($b)) ? 1 : -1;
}

/* Search for n top-lenth words in text */
function getTopLongestWords($text, $topCount = 3){
    $words = explode(' ', $text);
    $words = array_unique($words);
    usort($words, 'cmp');
    $words = array_slice($words,0, $topCount);
    return $words;

}

//var_dump($_REQUEST);
//if($_SERVER["REQUEST_METHOD"] == "POST"){
if (isset($_POST['action']) && isset($_POST["text1"]) && $_POST['action'] == 2){
    $text1 = $_POST["text1"];
    var_dump(getTopLongestWords($text1, 2));
    echo "<br>";
}

if(isset($_POST["text1"]) && isset($_POST["text2"]) && $_POST['action'] == 1){
    $text1 = $_POST["text1"];
    $text2 = $_POST["text2"];
    var_dump(getCommonWords($text1, $text2));
    echo "<br>";
}
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="" >
    <div style="clear: both"></div>
    <label for="text1">Text 1</label><br>
    <textarea name="text1" id="text1" cols="30" rows="10"></textarea>

    <div style="clear: both"></div>
    <label for="text2">Text 2</label><br>
    <textarea name="text2" id="text2" cols="30" rows="10"></textarea><br><br>

    <label for="action">Case param - 1 or 2</label><br>
    <input type="text" name="action" id="action" value="2"><br><br>

    <div style="clear: both"></div>
    <input type="submit" name="Ok" value="Ok">
</form>
</body>
</html>