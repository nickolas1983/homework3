<?php
session_start();

//var_dump($_POST);

require_once 'settings.php';
require_once 'functions.php';

require_once 'templates/header.php';

if (isset($_POST['action']) && $_POST['action'] = 'registration'){
    if (addUser($_POST['login'], $_POST['password'])){
        $_SESSION['isLogged'] = true;
        $_SESSION['login'] = $_POST['login'];
        createDir($_POST['login']);
        header('Location: index.php');
        die;
    }
    else{
        $errorMessage = 'Login already exists';
    }

}
?>
    <div id="content">
        <div class="form">
            <h1>Registration</h1>

            <?php
            if (isset($errorMessage)){
                echo $errorMessage;
            }
            ?>

            <form action="registration.php" method="post">

                <input type="hidden" name="action" value="registration">
                <label class="login" for="login">Login</label>
                <input class="login" type="text" name="login" id="login">

                <label class="login" for="password">Password</label>
                <input class="login" type="password" name="password" id="password">

                <input class="button" type="submit" value="Sing up">
            </form>

            <a href="login.php">Login</a>
        </div>
    </div>

<?php
require_once 'templates/footer.php';