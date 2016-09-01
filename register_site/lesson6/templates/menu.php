<?php

$menu = array(
    'Main' => "index.php?page=main",
    'Contact' => "index.php?page=contact",
    'Profile' => "index.php?page=profile",
    'Admin panel' => 'index.php?page=admin',
    'Logout' => 'index.php?action=logout',
);

/*
$pages = getUserPages(BD_FOLDER, $_SESSION['login']);

if(isset($pages) && $pages){
    $addPages = addUserPagesToMenu($pages);
}

$menu = array_merge($menu, $addPages);

$menu['Logout'] =  'index.php?action=logout';
*/

?>
<div id="menu">
    <nav>
        <ul>
            <?php  foreach ($menu as $title => $link) {?>
                <li><a href="<?php echo $link; ?>"><?php echo $title; ?></a> </li>
            <?php } ?>
            <li><?php if (isset($_SESSION['login'])) echo '[Current user: '.$_SESSION['login'].']'; ?></li>
        </ul>
    </nav>
</div>


