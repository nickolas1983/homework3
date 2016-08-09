<?php
function capitalLetters($str){
    $pattern = "/(^|\.)(\s*?\w)/u";
    return preg_replace_callback($pattern,
        function ($matches) {
            return mb_strtoupper($matches[0]);
        },
        $str);
}

$str = 'а васька слушает да ест. а воз и ныне там. а вы друзья как ни садитесь, все в музыканты не годитесь. а король-то — голый. а ларчик просто открывался.а там хоть трава не расти.';

echo  capitalLetters($str);
?>