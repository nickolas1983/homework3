<?php
function countWords($str1){
    return preg_match_all("/[а-яА-Яa-zA-Z0-9-_'рютьчыхцущёс]+/u", $str1);
}

echo countWords("Please note that's utf8_encode only converts a string encoded in ISO-8859-1 to UTF-8. A more appropriate name for it would be \"iso88591_to_utf8\"");
echo "<br>";
echo countWords("Деякі водії намагаються проскочити без черги. Їх з невеликим скандалом загортає поліція. Українські прикордонники кажуть, що за цей місяць, коли тимчасово призупинили малий прикордонний рух, на всьому західному кордоні не було затримок і черг");
?>