<?php
function backflip($matches){
    return implode( "", array_reverse( preg_split('//u',$matches[0],-1,PREG_SPLIT_NO_EMPTY) ) );
}

function backflipWords($str1){
    return preg_replace_callback ( "/[а-яА-Яa-zA-Z0-9-_'рютьчыхцущёсії]+/ui" , "backflip" , $str1);
}

echo backflipWords("Please note that's utf8_encode only converts a string encoded in ISO-8859-1 to UTF-8. A more appropriate name for it would be \"iso88591_to_utf8\"");
echo "<br>";
echo backflipWords("Деякі водії намагаються проскочити без черги. Їх з невеликим скандалом загортає поліція. Українські прикордонники кажуть, що за цей місяць, коли тимчасово призупинили малий прикордонний рух, на всьому західному кордоні не було затримок і черг");