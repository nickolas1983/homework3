<?php
$menu = array(
    'Main' => "index.php?page=main",
    'Contact' => "index.php?page=contact",
    'Admin panel' => 'index.php?page=admin',
    'Logout' => 'index.php?action=logout',
);


?>
<div id="menu">
    <nav>
        <ul>
            <?php  foreach ($menu as $title => $link) {?>
                <li><a href="<?php echo $link; ?>"><?php echo $title; ?></a> </li>
            <?php } ?>
        </ul>
    </nav>
</div>


