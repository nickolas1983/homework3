<?php
session_start();

//var_dump($_SESSION);

require_once 'settings.php';
require_once 'functions.php';

require_once 'templates/header.php';

/* Create count of attempts to login*/
$count = isset($_SESSION['count']) ? (int)$_SESSION['count'] : 0;
$_SESSION['count'] = $count;

if (isset($_POST['action']) && $_POST['action'] = 'login'){
    if(checkCredentials($_POST['login'], $_POST['password'])){

        $_SESSION['isLogged'] = true;
        $_SESSION['login'] = $_POST['login'];

        unset($_SESSION['count']);
        unset($_SESSION['momentOfBan']);

        header('Location: index.php');
        die;
    }
    else{
        $errorMessage = 'Wrong login or password';

        $_SESSION['count']++;               //count attempts to login

        if ($_SESSION['count'] >= 3){

            $_SESSION['momentOfBan'] = time();

            unset($_POST['action']);
            header('Location: login.php');
        }
    }

}

?>
    <div id="content">
        <div class="form">
            <h1>Login</h1>

            <?php
            if (isset($errorMessage)){
                echo '<b class="worning">'.$errorMessage.'</b>';
            }
            ?>

            <?php if (isset($_SESSION['momentOfBan']) && ($_SESSION['momentOfBan'] + 10 > time())){ //BAN
                $timeToUnban = (($_SESSION['momentOfBan'] + 10) - time());
                $minutesToUnban = (int)($timeToUnban/60);
                $secondsToUnban = $timeToUnban%60;

                echo "Unban in $minutesToUnban minutes $secondsToUnban seconds <br>";
            }
            elseif (isset($_SESSION['momentOfBan']) && ($_SESSION['momentOfBan'] + 10 < time())){ //UNBAN

                unset($_SESSION['count']);
                unset($_SESSION['momentOfBan']);

                header('Location: login.php');
            }
            else
            {?>


                <form action="login.php" method="post">

                    <input type="hidden" name="action" value="login">
                    <label class="login" for="login" >Login</label>
                    <input class="login" type="text" name="login" id="login">

                    <label class="login" for="password">Password</label>
                    <input class="login" type="password" name="password" id="password">

                    <input class="button" type="submit" value="Login">
                </form>
            <?php }?>

            <a href="registration.php">Sing up</a>
        </div>
    </div>

<?php
require_once 'templates/footer.php';