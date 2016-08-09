<?php

var_dump($_POST);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["pole"])){
        echo $_POST["pole"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="http://localhost:8081/lessons/PHPacademy/forma.php" >
    <textarea></textarea>
    <input name="pole" type="text"> Текст
    <input type="submit" name="Ok" value="Ok">
</form>
</body>
</html>