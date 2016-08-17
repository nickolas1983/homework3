<?php

function checkAndUploadFile($file, &$message, &$errorMessage, $category = 'All') {

    global $allowedTypes;
    
    if ( in_array($file['type'], $allowedTypes) ) {

        $fileName = $file['tmp_name'];

        if ($category == 'All') {
            $category = GALLERY_FOLDER ;
        }
        elseif ($category != '') {
            $category .= '/';
        }
        $destination = $category . $file['name'];

        //$destination = GALLERY_FOLDER . md5(time());

        if(move_uploaded_file($fileName, $destination)) {
            $message = 'Your image was uploaded!';
        }
    } else {
        $errorMessage = 'File has a wrong format!';
    }
}

function removeFile($filename) {
    return unlink($filename);
}

function cmpSize($a, $b) {
    if (filesize($a) == filesize($b)) {
        return 0;
    }
    return (filesize($a) < filesize($b)) ? 1 : -1;
}

function choseCategory($category) {

    if ($category == 'All') {
        $array1 = glob(GALLERY_FOLDER . '*/*.*');
        $array2 = glob(GALLERY_FOLDER . '*.*');
        $images = array_merge($array1, $array2);
        return $images;
    }
    else {
        return glob($category . '/*.*');
    }
}

function createDir($name) {
    if (!file_exists(GALLERY_FOLDER . $name)) {
        $name = iconv("UTF-8", "windows-1251", $name);
        mkdir(GALLERY_FOLDER . $name);
    }
}

function cmpTimeFileChange($a, $b) {
    if (filemtime($a) == filemtime($b)) {
        return 0;
    }
    return (filemtime($a) < filemtime($b)) ? 1 : -1;
}

function lastChangeFileIcon($category = 'All') {

    $array = choseCategory($category);

    usort($array, 'cmpTimeFileChange');

    if(count($array) > 0) {
        $icon = $array[0];
    }
    else {
        $icon = "images/folder.png";
    }
    return $icon;
}

function countFoto($category = 'All') {

    return count(choseCategory($category));
}

function dellAll($dir){
    $list = glob($dir."/*");
    for ($i = 0; $i < count($list); $i++){
        if (is_dir($list[$i])) dellAll($list[$i]);
        else unlink($list[$i]);
    }
    rmdir($dir);
}

function renameCategory($oldName, $newName) {
    $newName = GALLERY_FOLDER . $newName;
    rename($oldName, $newName);
}
