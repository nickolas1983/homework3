<?php
function backflip($str){
    return implode( "", array_reverse( preg_split('//u',$str,-1,PREG_SPLIT_NO_EMPTY) ) ); 
}

if (isset($_POST['word'])){
    $str = backflip($_POST['word']);
}
else{
    $str = '';    
}
?>

<form action="" method="post">
    <label for="word">Введите слово</label><br><br>
    <input type="text" name="word" id="word"><br><br>
    <input type="submit" value="Ok">
</form>

<p>Результат: <?php echo $str?></p>
