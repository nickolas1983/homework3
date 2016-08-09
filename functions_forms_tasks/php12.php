<?php
function backflipSentences($str){

    $array = preg_split('/\.\s*?/u',$str);
    unset($array[count($array)-1]);
    $str = implode( ". ", array_reverse($array) ).'.';
    return $str;
}

$str = 'А Васька слушает да ест. А воз и ныне там. А вы друзья как ни садитесь, все в музыканты не годитесь. А король-то — голый. А ларчик просто открывался. А там хоть трава не расти.';

echo backflipSentences($str);
?>