<?php

$colors = array(
    'Blue' => 'styles/blue.css',
    'Red' => 'styles/red.css',
    'green' => 'styles/green.css'
);


/* Change password */
if (isset($_POST['action']) && $_POST['action'] == 'changePassword'){
    if (isset($_POST['oldPassword']) && isset($_POST['password'])){
        if (changePassword($_SESSION['login'], $_POST['oldPassword'], $_POST['password'])){
            $cangePassMessage = 'Password was changed';
        }
        else {
            $cangePassMessage = 'Wrong old password or something else';
        }
    }

}

//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';

/* Personal data */
if (isset($_POST['action']) && $_POST['action'] == 'personal'){
    $message = '';
    $errorMessage = '';
    checkAndUploadFile($_FILES['image'], $message, $errorMessage);
    addChangeProfile($_POST);
}

/* Profile data */

$data = extractProfile($_SESSION['login']);

/* List of pages */

$userPages = getUserPages(BD_FOLDER, $_SESSION['login']);

/* Add new page*/

if (isset($_POST['add']) && $_POST['add']){

    $add = true;
}

if (isset($_POST['action']) && $_POST['action'] == 'pageCreation'){

    addChangeUserPage($_POST['name'],$_POST['content']);
    $name = $_POST['name'];
    $pageContent = extractUserPage($_SESSION['login'], $_POST['name']);
    $add = true;
}

/* Change existing page*/

if (isset($_POST['change']) && $_POST['change']){

    $change = true;
}

if (isset($_POST['changePage']) && $_POST['changePage']){
    $change = true;
    $editor = true;
    $chosenPage = $_POST['changePage'];
    $pageContent = extractUserPage($_SESSION['login'], $chosenPage);
}

if (isset($_POST['action']) && $_POST['action'] == 'pageContent'){
    $change = true;
    $editor = true;
    $chosenPage = $_POST['chosenPage'];
    addChangeUserPage($_POST['chosenPage'],$_POST['content']);
    $pageContent = extractUserPage($_SESSION['login'], $chosenPage);
}

/* Delete page */
//var_dump($_POST);

if (isset($_POST['delete']) && $_POST['delete']){

    $delete = true;
}

if (isset($_POST['deletePage']) && $_POST['deletePage']){
    $delete = true;
    $chosenPage = $_POST['deletePage'];
    if(dellPage($chosenPage) !== false){
        $deleteMessage = $chosenPage.' was deleted.';
        $userPages = getUserPages(BD_FOLDER, $_SESSION['login']);
    }
    else {
        $deleteMessage = $chosenPage." wasn't deleted.";
    }
}

?>

<h1>Admin page</h1>

<div class="blockStyle">

    <h3>Choose your preferred color:</h3>

    <form action="index.php?page=admin" method="post">
        <input type="hidden" name="action" value="style">
        <label for="color"></label>
        <select name="color" id="color">
            <?php foreach($colors as $title => $color) { ?>
                <option <?php if($color == getUsersColor()) echo 'selected' ?> value="<?php echo $color ?>"><?php echo $title ?></option>
            <?php } ?>
        </select>


        <input type="submit" value="Save">
    </form>

    <h3>Change password</h3>

    <?php if (isset($cangePassMessage)){
        echo $cangePassMessage;
    } ?>

    <form action="index.php?page=admin" method="post">
        <input type="hidden" name="action" value="changePassword">

        <label class="paragraphStyle1" for="oldPassword">Old password</label>
        <input class="paragraphStyle1" type="password" name="oldPassword" id="oldPassword">

        <label class="paragraphStyle1" for="password">New password</label>
        <input class="paragraphStyle1" type="password" name="password" id="password">

        <input class="button" type="submit" value="Change">
    </form>

    <h3 class="paragraphStyle1">Your foto</h3>

    <div class="categoryImage"  style="background: center url('<?php echo BD_FOLDER . '/' . $_SESSION['login'] . '/foto.jpeg';?>')  no-repeat; background-size: cover">
    </div>

</div>

<div class="blockStyle">

    <h3>Personal data</h3>

    <form action="index.php?page=admin" method="post" enctype="multipart/form-data">
        <input class="paragraphStyle1" type="hidden" name="action" value="personal">

        <label class="paragraphStyle1" for="image">Add your foto</label>
        <input class="paragraphStyle1" type="file" name="image" id="image">

        <?php
        if(isset($errorMessage)) {
            echo $errorMessage;
        }
        ?>

        <label class="paragraphStyle1" for="fio">Your full name</label>
        <input class="paragraphStyle1" type="text" name="fio" id="fio" value="<?php if(isset($data['fio'])) {
            echo $data['fio'];
        } ?>">

        <label class="paragraphStyle1" for="birthday">Your birthday</label>
        <input class="paragraphStyle1" type="text" name="birthday" id="birthday" value="<?php if(isset($data['birthday'])) {
            echo $data['birthday'];
        } ?>">

        <label class="paragraphStyle1" for="city">Your city</label>
        <input class="paragraphStyle1" type="text" name="city" id="city" value="<?php if(isset($data['city'])) {
            echo $data['city'];
        } ?>">

        <label class="paragraphStyle1" for="about">About yourself</label>
        <textarea class="paragraphStyle1" name="about" id="about" rows="20"><?php if(isset($data['about'])) {
                echo $data['about'];
            } ?></textarea>

        <input class="button" type="submit" value="Save">
    </form>
</div>


<div class="blockStyle">

    <h3>Create your own page</h3>

    <form action="index.php?page=admin" method="post">
        <button name="add" value="add">Add new page</button>
        <button name="change" value="change">Change page</button>
        <button name="delete" value="delete">Delete page</button>
    </form>

    <?php
    if (isset($add) and $add === true){ ?>

        <form action="index.php?page=admin" method="post">
            <input type="hidden" name="action" value="pageCreation">

            <label class="paragraphStyle1" for="name">New page</label>
            <input class="paragraphStyle1" type="text" name="name" id="name" value="<?php if(isset($name)) {
                echo $name;
            } ?>">

            <label class="paragraphStyle1" class="paragraphStyle1" for="content">Write code of your page</label>
            <textarea name="content" id="content" cols="77" rows="28"><?php if(isset($pageContent)) {
                    echo $pageContent;
                } ?></textarea><br>

            <input class="button" type="submit" value="Add">
        </form>
    <?php } ?>

    <?php if (isset($change) && $change === true) { ?>

        <form action="index.php?page=admin" method="post">

            <label class="paragraphStyle1" for="changePage">Change page</label>
            <select class="paragraphStyle2" name="changePage">
                <?php
                foreach ($userPages as $userPage) {
                    ?>
                    <option <?php if (isset($chosenPage) && $userPage == $chosenPage) echo 'selected' ?>
                        value="<?php echo $userPage; ?>"><?php echo $userPage; ?></option>
                <?php } ?>
            </select>
            <input class="button" type="submit" value="Chose">
        </form>

        <?php if (isset($editor) && $editor === true) { ?>
            <form action="index.php?page=admin" method="post">
                <input type="hidden" name="action" value="pageContent">

                <input type="hidden" name="chosenPage" value="<?php echo $chosenPage;?>">

                <label class="paragraphStyle1" for="content">Write code of your page</label>
            <textarea name="content" id="content" cols="77" rows="27"><?php if(isset($pageContent)) {
                    echo $pageContent;
                } ?></textarea><br>

                <input class="button" type="submit" value="Save">
            </form>
        <?php }
    }
    ?>

    <?php if (isset($delete) && $delete === true) {

        if (isset($deleteMessage)) {
            echo $deleteMessage;
        }
        ?>

        <form action="index.php?page=admin" method="post">
            <label class="paragraphStyle1" for="deletePage">Delete page</label>
            <select class="paragraphStyle2" name="deletePage">
                <?php
                foreach ($userPages as $userPage) {
                    ?>
                    <option <?php if (isset($chosenPage) && $userPage == $chosenPage) echo 'selected' ?>
                        value="<?php echo $userPage; ?>"><?php echo $userPage; ?></option>
                <?php } ?>
            </select>
            <input class="button" type="submit" value="Delete">
        </form>
    <?php }?>

</div>