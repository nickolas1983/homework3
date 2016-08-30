<?php

function getPageName($allowedPages) {
    $page = 'main';
    if (isset($_GET['page']) && $_GET['page'] && in_array($_GET['page'],$allowedPages)){
        $page = $_GET['page'];
    }
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