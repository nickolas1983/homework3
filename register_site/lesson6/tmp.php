<?php
$userPages = getUserPages(BD_FOLDER, $_SESSION['login']);

if (isset($_POST['action']) && $_POST['action'] == 'pageCreation'){
if (isset($_POST['name']) && $_POST['name']){
$editor = true;
$chosenPage = $_POST['name'];
}
elseif (isset($_POST['changePage']) && $_POST['changePage']){
$editor = true;
$chosenPage = $_POST['changePage'];
$pageContent = extractUserPage($_SESSION['login'], $chosenPage);
}
else {
$editor =false;
}
}

/* Edit page */

if (isset($_POST['action']) && $_POST['action'] == 'pageContent'){
if (isset($_POST['content']) && $_POST['content']){
$editor = true;
$chosenPage = $_POST['changePage'];
addChangeUserPage($_POST['chosenPage'],$_POST['content']);
}
}
?>

<form action="index.php?page=admin" method="post">

    <input type="hidden" name="action" value="pageCreation">

    <label for="name">New page</label>
    <input type="text" name="name" id="name">

    <label for="changePage">Change page</label>
    <select name="changePage">
        <?php
        foreach ($userPages as $userPage){?>
            <option value="<?php echo $userPage;?>"><?php  echo $userPage;?></option>
        <?php }?>
    </select>

    <input type="submit" value="Chose">
</form>

<?php if (isset($editor) &&  $editor){ ?>
    <form action="index.php?page=admin" method="post">

        <input type="hidden" name="action" value="pageContent">

        <input type="hidden" name="chosenPage" value="<?php echo $chosenPage;?>">

        <label class="paragraphStyle1" for="content">Write code of your <?php echo $chosenPage;?> page</label>
        <textarea name="content" id="content" cols="100" rows="30"><?php if(isset($pageContent)) {
                echo $pageContent;
            } ?></textarea><br>

        <input class="button" type="submit" value="Add">
    </form>
<?php } ?>

<form action="index.php?page=admin" method="post">
    <input type="hidden" name="action" value="pageRemuving">
    <input type="text" name="name">
    <input type="submit" value="Add">
</form>