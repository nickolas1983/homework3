<?php
session_start();
include 'include\settings.php';
include 'include\functions.php';
include 'head.php';

//unset($_SESSION['gallery']);
//unset($_SESSION['category']);

/* chose category */
if(isset($_POST['chose'])) {

    if ($images = choseCategory($_POST['chose'])) {
        $_SESSION['gallery'] = $images;
        $_SESSION['category'] = $_POST['chose'];
        //var_dump($gallery);
        header('Location: gallery.php');
    }
    if (count(choseCategory($_POST['chose'])) == 0){
        $_SESSION['category'] = $_POST['chose'];
        header('Location: addFile.php');
    }
}

/* Add category */
if(isset($_POST['action']) && $_POST['action'] == 'refactorCategory') {
    if (isset($_POST['create']) && $_POST['create'] == 'Add'){
        if (createDir($_POST['name'])){
            header('Location: categorys.php');
        }
    }
}

/* Delete category */
if(isset($_POST['delete'])) {
        if (dellAll($_POST['delete'])){
            header('Location: categorys.php');
        }
}

/* Rename category */
if(isset($_POST['rename'])) {
    $_SESSION['oldName'] = $_POST['rename'];
    header('Location: rename.php?');
}

if (isset($_POST['newName']) && isset($_SESSION['oldName']) && isset($_POST['Ok'])) {
    if (renameCategory($_SESSION['oldName'], $_POST['newName'])) {
        header('Location: categorys.php');
    }
}

/* categores */
$categores = glob(GALLERY_FOLDER. '*', GLOB_ONLYDIR);


?>


<h1>Gallery</h1>

<form action="" method="post">
    <input type="hidden" name="action" value="refactorCategory">
    <h2>Add category</h2>
    <input type="text" name="name">
    <input type="submit" value="Add" name="create">
</form>

<form action="" method="post">

    <div class="grid">

        <button name="chose" value="All">

            <div  class="categoryImage" style="background: center url(<?php echo lastChangeFileIcon();?>)  no-repeat; background-size: cover">
            </div>

            <p>All</p>

            <p>
                <span class="count"> <?php echo countFoto();?> </span>
                <img  src="images/photo.png" class="countImage">
            </p>

        </button>
        <br><br>
        <br>
    </div>

    <?php foreach ($categores as $category){
        $category = iconv('Windows-1251', 'UTF-8', $category);
        ?>
    <div class="grid" ">
        <button name="chose" value="<?php echo $category;?>">

            <div class="categoryImage"  style="background: center url('<?php echo lastChangeFileIcon($category);?>')  no-repeat; background-size: cover">
            </div>

            <p>
                <?php echo str_replace(GALLERY_FOLDER, '', $category) ;?>
            </p>

            <p>
                <span class="count"> <?php echo countFoto($category);?> </span>
                <img src="images/photo.png" class="countImage">
            </p>

        </button>
        <div class="button">
            <button value="<?php echo $category;?>" name="delete">Delete</button>
            <button value="<?php echo $category;?>" name="rename">Rename</button>
        </div>

    </div>
    <?php } ?>

</form>
<?php  include 'footer.php'; ?>


