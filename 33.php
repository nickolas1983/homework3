<?php
$str = "Деякі водії :) намагаються проскочити без черги:) Їх з невеликим скандалом загортає поліція:) Українські прикордонники кажуть, що за цей місяць";
function smile($str)
{
    $reg = "/[:)]+/";
    $replace = "<img src=\"Smiley.png\" width=\"32\">";
    return preg_replace($reg, $replace, $str);
}

echo smile($str);
?>

