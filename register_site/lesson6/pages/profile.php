<?php

$user = $_SESSION['login'];
$data = extractProfile($user);
$logins =  getUsers(BD_FOLDER);
$pages = getUserPages(BD_FOLDER, $_SESSION['login']);

if(isset($_POST['action']) && $_POST['action'] == 'users') {
    $user = $_POST['user'];
    $data = extractProfile($user);
    $pages = getUserPages(BD_FOLDER, $user);
}



//var_dump($_POST);

if(isset($_POST['action']) && $_POST['action'] == 'chosePage') {
    $chosePage = $_POST['page'];
    $user = $_POST['user'];
    $data = extractProfile($user);
    $pages = getUserPages(BD_FOLDER, $user);
    $addPage =true;
}

?>

<div>
    <form method="post" action="index.php?page=profile"">

    <input type="hidden" name="action" value="users">

    <label class="paragraphStyle1" for="user">Chose profile</label>
    <select class="paragraphStyle2" name="user" id="user">
        <?php
        foreach ($logins as $login){?>
            <option <?php if (isset($user) && $login == $user) echo 'selected';?> value="<?php echo $login;?>"><?php  echo $login;?></option>
        <?php }?>
    </select>
    <input class="button" type="submit" value="choose">
    </form>

        <div class="blockStyle">
            <div class="categoryImage"  style="background: center url('<?php echo BD_FOLDER . '/' .$user . '/foto.jpeg';?>')  no-repeat; background-size: cover">
            </div>
        </div>


        <div class="blockStyle2">
            <h2 class="paragraphStyle3" ><?php if(isset($data['fio'])) {
                    echo $data['fio'];
                } ?></h2>
            <p  class="paragraphStyle3"><?php if(isset($data['birthday'])) {
                    echo 'Birthday: '.$data['birthday'];
                } ?></p>
            <p class="paragraphStyle3"><?php if(isset($data['city'])) {
                    echo 'City: '.$data['city'];
                } ?></p>
            <p class="paragraphStyle3"><?php if(isset($data['about'])) {
                    echo 'About me: <br>'.$data['about'];
                } ?></p>
        </div>

</div>

<div >
    <form method="post" action="index.php?page=profile"">

    <input type="hidden" name="action" value="chosePage">

    <input type="hidden" name="user" value="<?php echo $user;?>">

    <label class="paragraphStyle1" for="page">Chose page</label>
    <select class="paragraphStyle2" name="page" id="page">
        <?php
        foreach ($pages as $page){?>
            <option <?php if (isset($chosePage) && $page == $chosePage) echo 'selected';?> value="<?php echo $page;?>"><?php  echo $page;?></option>
        <?php }?>
    </select>

    <input class="button" type="submit" value="choose">
    </form>
    
    <h2 class="paragraphStyle3" ><?php if(isset($chosePage)) {
            echo $chosePage;
        } ?></h2>
    <div class="blockStyle">

        <?php

        if (isset($chosePage) && $chosePage){
            include BD_FOLDER.$user."/{$chosePage}.php";
        }
        
        ?>
    </div>

</div>

