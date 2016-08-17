<?php

function checkAndUploadFile($file, &$message, &$errorMessage, $category = 'All') {

    global $allowedTypes;

    if ( in_array($file['type'], $allowedTypes) ) {

        $fileName = $file['tmp_name'];

        if ($category == 'All') {
            $category = GALLERY_FOLDER ;
        }
        elseif ($category != '') {
            $category =  iconv('UTF-8', 'Windows-1251', $category);
            $category .= '/';
        }
        $destination = $category . iconv('UTF-8', 'Windows-1251', $file['name']) ;

        //$destination = GALLERY_FOLDER . md5(time());

        if(move_uploaded_file($fileName, $destination)) {
            $message = 'Your image was uploaded!';
        }
    } else {
        $errorMessage = 'File has a wrong format!';
    }
}

function removeFile($filename) {
    return unlink(iconv('UTF-8', 'Windows-1251', $filename));
}

function cmpSize($a, $b) {
    $a = iconv('UTF-8', 'Windows-1251', $a);
    $b = iconv('UTF-8', 'Windows-1251', $b);
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
        $resultImages = array();

        foreach ($images as $image) {
            $resultImages[] = iconv( 'Windows-1251', 'UTF-8', $image);
        }
        return $resultImages;
    }
    else {
        $images = glob(iconv( 'UTF-8', 'Windows-1251', $category) . '/*.*');
        $resultImages = array();

        foreach ($images as $image) {
            $resultImages[] = iconv( 'Windows-1251', 'UTF-8', $image);
        }
        return $resultImages;
    }
}

function createDir($name) {
    if (!file_exists(GALLERY_FOLDER . $name)) {
        $name = iconv("UTF-8", "windows-1251", $name);
        mkdir(GALLERY_FOLDER . $name);
    }
}

function cmpTimeFileChange($a, $b) {
    $a = iconv('UTF-8', 'Windows-1251', $a);
    $b = iconv('UTF-8', 'Windows-1251', $b);

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
    $dir = iconv('UTF-8', 'Windows-1251', $dir);
    $list = glob($dir."/*");
    for ($i = 0; $i < count($list); $i++){
        $listTmp = $list[$i];
        if (is_dir($listTmp)) dellAll($listTmp);
        else unlink($listTmp);
    }
    rmdir($dir);
}

function renameCategory($oldName, $newName) {
    $newName = iconv('UTF-8', 'Windows-1251', $newName);
    $oldName = iconv('UTF-8', 'Windows-1251', $oldName);
    $newName = GALLERY_FOLDER . $newName;
    rename($oldName, $newName);
}
