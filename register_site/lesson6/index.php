<?php
session_start();

/*adding functionality*/
require_once 'functions.php';
require_once 'settings.php';


/**/

if (!isLogged()){
    header('Location: login.php');
    die;
}

if (isset($_GET['action']) && $_GET['action'] == 'logout'){
    logout();
    header('Location: login.php');
}

if(isset($_POST['action']) && $_POST['action'] == 'style') {
    setcookie('color', $_POST['color'], time() + 60 * 60 * 60 );
    $_COOKIE['color'] = $_POST['color'];
}

require_once 'templates/header.php';

include 'templates/menu.php';

/* adding content */

$page = getPageName($allowedPages);
?>

    <div id="content">
        <div class="content">
            <?php
            include "{$page}.php";
            ?>
        </div>
    </div>

<?php
require_once 'templates/footer.php';
?>