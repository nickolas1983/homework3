<?php
function countUniqueWords($text){
    return count(array_unique(explode(' ', $text)));
}

if (isset($_POST['text'])){
    $text = $_POST['text'];
    $count = countUniqueWords($text);
}
else {
    $text = '';
    $count = 0;
}
?>

<form method="post" action="">
    <label for="text">Введите текст (слова разделяются пробелом)</label><br><br>
    <textarea name="text" id="text" cols="30" rows="10">
        <?php
        if ($text){
            echo $text;
        }
        ?>
    </textarea><br><br>
    <input type="submit" value="OK">
</form>

<p>Результат: <?php echo $count?></p>
