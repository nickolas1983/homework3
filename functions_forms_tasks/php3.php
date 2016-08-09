<?php
/* Delete words wich equal or longer then $length */
function clearFileFromLongWords($path, $length){
    $str = file_get_contents($path);
    $pattern = "/[а-яА-Яa-zA-Z0-9-_'ёії]{{$length},}/ui";
    $str = preg_replace( $pattern , "", $str);
    file_put_contents($path, $str);
}

if (isset($_POST['length'])){
    $lenght = $_POST['length'];
    clearFileFromLongWords('php3.txt', $lenght);
}
?>

<form action="" method="post">
    <label for="length">Length of removable words</label><br>
    <input type="text" name="length" id="length"><br>
    <input type="submit" name="Ok" value="Ok">
</form>
