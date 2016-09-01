<?php

function getPageName($allowedPages) {

    $page = PAGES_FOLDER.'main';

    //$addPages = getUserPages(BD_FOLDER, $_SESSION['login']);

    if (isset($_GET['page']) && $_GET['page'] && in_array($_GET['page'],$allowedPages)){

        $page = PAGES_FOLDER.$_GET['page'];
    }
    
    /*
    elseif (isset($_GET['page']) && $_GET['page'] && $addPages && in_array($_GET['page'],$addPages)){

        $page = BD_FOLDER.$_SESSION['login'].'/'.$_GET['page'];
    }
    */

    return $page;
}

function checkCredentials($login, $password){

    $str = file_get_contents(USERS_BD);
    $users = unserialize($str);
    
    if (is_array($users)) {
        
        if (array_key_exists($login, $users) && $users[$login] == crypt($password, SALT)) {
            return true;
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}

function changePassword($login, $oldPass, $newPass){

    $str = file_get_contents(USERS_BD);
    $users = unserialize($str);
    
    if (array_key_exists($login, $users) && $users[$login] == crypt($oldPass, SALT)){
        
        $users[$login] = crypt($newPass, SALT);
        $str = serialize($users);
        file_put_contents(USERS_BD, $str);
        return true;
    }
    else {
        return false;
    }
}

function addUser($login = '', $password = ''){

    $str = file_get_contents(USERS_BD);
    $users = unserialize($str);
    
    if (is_array($users)){
        
        if (array_key_exists($login, $users)){
            return false;
        }
        else {
            $users[$login] = crypt($password, SALT);
            $str = serialize($users);
            file_put_contents(USERS_BD, $str);
            return true;
        }
    }
    else {
        $users[$login] = crypt($password, SALT);
        $str = serialize($users);
        file_put_contents(USERS_BD, $str);
        return true;
    }
}

function isLogged(){
    
    if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']){
        return true;
    }
    
    return false;
}

function logout(){
    unset($_SESSION['isLogged']);   
}

function getUsersColor(){
    
    $color = 'green';
    
    if(isset($_COOKIE['color'])) {
        $color = $_COOKIE['color'];
    }

    return $color;
}

function createDir($name) {
    
    if (!file_exists(BD_FOLDER . $name)) {
        
        $name = iconv("UTF-8", "windows-1251", $name);
        mkdir(BD_FOLDER . $name);
    }
}

function checkAndUploadFile($file, &$message, &$errorMessage) {

    global $allowedTypes;

    if ( in_array($file['type'], $allowedTypes) ) {
        if ( isset($_SESSION['login']) && file_exists(BD_FOLDER.$_SESSION['login'])) {

            $fileName = $file['tmp_name'];

            $destination = BD_FOLDER . '/' . $_SESSION['login'] . '/foto.jpeg';

            if (move_uploaded_file($fileName, $destination)) {
                $message = 'Your image was uploaded!';
            }
        }
        else {
            $errorMessage = 'Wrong login!';
        }

    } else {
        $errorMessage = 'File has a wrong format!';
    }
}

function addChangeProfile($post){
    
    $str = serialize($post);
    $destination = BD_FOLDER . '/' . $_SESSION['login'] . '/profile.txt';
    file_put_contents($destination, $str);
}

function extractProfile($login){
    
    $destination = BD_FOLDER . '/' . $login . '/profile.txt';
    
    if (file_exists($destination)){
        
        $str = file_get_contents($destination);
        return unserialize($str);
    }
    else {
        return false;
    }
}

function getUsers($BD_FOLDER){

    $logins = scandir($BD_FOLDER);

    for($i = 1; $i < count($logins); $i++){

        if (stripos ($logins[$i], '.') !== false){
            //unset($logins[$i]);
            $logins[$i] = '';
        }
    }

    return array_unique($logins);
}

function addChangeUserPage($pageName, $content){
    $destination = BD_FOLDER . '/' . $_SESSION['login'] . '/'.$pageName.'.php';
    file_put_contents($destination, $content);
}

function extractUserPage($login, $pageName){

    $destination = BD_FOLDER . '/' . $login .  '/'.$pageName.'.php';

    //echo $destination.'<br>';

    if (file_exists($destination)){

        $content = file_get_contents($destination);
        return $content;
    }
    else {
        return false;
    }
}

function getUserPages($BD_FOLDER, $login){

    $path = $BD_FOLDER.$login.'/';
    $pages = scandir($path);

    $returnArray =array();

    for($i = 1; $i < count($pages); $i++){

        if (strpos ($pages[$i], '.php') !== false){

            $returnArray[] = substr($pages[$i], 0, strpos ($pages[$i], '.php'));
        }
    }
    if ($returnArray){
        return array_unique($returnArray);
    }
    else{
        return false;
    }
}

function dellPage($pageName){
    $destination = BD_FOLDER . '/' . $_SESSION['login'] .  '/'.$pageName.'.php';
    if (isset($destination)){
        unlink($destination);
    }
    else{
        return false;
    }
}

function addUserPagesToMenu($pages){
    $addPages = array();
    foreach ($pages as $page){

        $tmpPage = $page;
        $page[0] = strtoupper($page[0]);
        $link = 'index.php?page='.$tmpPage;
        $addPages[$page] = $link;
    }
    
    return $addPages;
}

