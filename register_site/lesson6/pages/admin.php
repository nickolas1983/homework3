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
    //header('Location: index.php?page=admin');
}




?>
<h1>Admin page</h1>

<div class="admin">
    <h3>Personal data</h3>
    <form action="index.php?page=admin" method="post" enctype="multipart/form-data">
        <input class="login" type="hidden" name="action" value="personal">

        <label class="login" for="image">Add your foto</label>
        <input class="login" type="file" name="image" id="image">

        <?php
        if(isset($errorMessage)) {
            echo $errorMessage;
        }
        ?>

        <label class="login" for="fio">Your full name</label>
        <input class="login" type="text" name="fio" id="fio">

        <label class="login" for="birthday">Your birthday</label>
        <input class="login" type="text" name="birthday" id="birthday">

        <label class="login" for="city">Your city</label>
        <input class="login" type="text" name="city" id="city">

        <label class="login" for="about">About yourself</label>
        <textarea class="login" name="about" id="about" rows="20"></textarea>

        <input class="button" type="submit" value="Save">
    </form>
</div>

<div class="admin">
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

        <label class="login" for="oldPassword">Old password</label>
        <input class="login" type="password" name="oldPassword" id="oldPassword">

        <label class="login" for="password">New password</label>
        <input class="login" type="password" name="password" id="password">

        <input class="button" type="submit" value="Change">
    </form>

    <div class="categoryImage"  style="background: center url('<?php echo BD_FOLDER . '/' . $_SESSION['login'] . '/foto.jpeg';?>')  no-repeat; background-size: cover">
    </div>
</div>


