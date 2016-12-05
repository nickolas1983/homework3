<?php

session_start();


require_once 'settings.php';
require_once 'includes.php';
    


$controller = 'Index';
$action = 'index';
$parameter1 = null;
$parameter2 = null;
$parameter3 = null;




if( isset($_GET['route'])) {

    $route = explode('/', $_GET['route']);
    if(isset($route[0])) {
        $controller = ucfirst($route[0]);
    }
    if(isset($route[1])) {
        $action = $route[1];
    }
    if(isset($route[2])) {
        $parameter1 = $route[2];
    }
    if(isset($route[3])) {
        $parameter2 = $route[3];
    }
    if(isset($route[4])) {
        $parameter3 = $route[4];
    }
}



$controllerName = "\\Controller\\{$controller}Controller";

$controllerObj = new $controllerName();

if(is_callable(array($controllerObj, $action))) {
    //var_dump($parameters);
	
    $controllerObj->$action($parameter1, $parameter2, $parameter3);
} else {
    echo 'Starting default!';
    $controllerObj->index($parameter1);
}

