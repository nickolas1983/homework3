<?php
session_start();
include 'include\settings.php';
include 'include\functions.php';
include 'head.php';




if(isset($_POST['action']) && $_POST['action'] == 'add') {
   checkAndUploadFile($_FILES['image'], $message, $errorMessage, $_SESSION['category']);
}
?>

<h2>Add your image</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add">
    <input type="file" name="image">
    <input type="submit" value="Add">
</form>

<?php if(isset($message)) { ?>
    <div style="color:green"><?php echo $message ?></div>
<?php } ?>

<?php if(isset($errorMessage)) { ?>
    <div style="color:red"><?php echo $errorMessage ?></div>
<?php } ?>

<a href="index.php">Back to gallery</a>
<?php  include 'footer.php'; ?>