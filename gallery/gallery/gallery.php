<?php

session_start();
include 'include\settings.php';
include 'include\functions.php';
include 'head.php';

$message = '';
if(isset($_GET['performedAction']) && $_GET['performedAction'] == 'remove') {
    $message = 'Image was removed!';
}
$errorMessage = '';

/* adding file */
if(isset($_POST['action']) && $_POST['action'] == 'add') {
    header('Location: addFile.php');
}
/* remove file */
if(isset($_POST['delete'])) {
    if(removeFile($_POST['delete'])){
        header('Location: gallery.php?performedAction=remove');
    }
}

$images = choseCategory($_SESSION['category']);

/* sort files */
if(isset($_POST['action']) && $_POST['action'] == 'sort') {
    if ($_POST['sort'] == 'fileName'){
        asort($images);
    }
    elseif ($_POST['sort'] == 'fileSize'){
        usort($images, 'cmpSize');
    }
}

?>


<h1>Gallery</h1>
<h2> <?php echo 'Category: ' . str_replace(GALLERY_FOLDER, '', $_SESSION['category']); ?> </h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add">
    <input type="submit" value="Add foto" class="addFoto">
</form>

<a href="index.php">Back to gallery</a>

<?php if(isset($message)) { ?>
<div class="message"><?php echo $message ?></div>
<?php } ?>

<?php if(isset($errorMessage)) { ?>
    <div class="errorMessage""><?php echo $errorMessage ?></div>
<?php } ?>

<form action="" method="post">
    <input type="hidden" name="action" value="sort">
    <h3>Sort by </h3>
    <button value="fileName" name="sort">Name</button>
    <button value="fileSize" name="sort">Size</button>
</form>

<div id="gallery">
<?php foreach ($images as $image) {
    //$image = iconv('Windows-1251', 'UTF-8', $image);
    ?>
    <div class="grid">
        <a href="<?php echo $image ?>" >
            <div class="image"  style="background: center url(<?php echo $image ?>)  no-repeat; background-size: cover;">
            </div>
        </a>
        <form action="" method="post" class="button" >
            <button value="<?php echo $image ?>" name="delete">Delete</button>
        </form>
    </div>
<?php } ?>
</div>
<?php  include 'footer.php'; ?>









