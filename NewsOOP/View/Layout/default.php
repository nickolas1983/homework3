<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_NAME; ?></title>
    <base href="/">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="http://getbootstrap.com/examples/starter-template/starter-template.css"/>
    <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.css"/>
    <link rel="stylesheet" href="../../public/styles/fotorama.css"/>
    <link rel="stylesheet" href="../../public/styles/style.css"/>

    <!-- Latest compiled and minified JavaScript -->
    <script src="public/js/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="public/js/fotorama.js"></script>
    <script src="public/js/pages.js"></script>


    <!-- arcticModal -->
    <script src="public/js/arcticmodal/jquery.arcticmodal-0.3.min.js"></script>
    <link rel="stylesheet" href="public/js/arcticmodal/jquery.arcticmodal-0.3.css">

    <!-- arcticModal theme -->
    <link rel="stylesheet" href="public/js/arcticmodal/themes/simple.css">


</head>
<body <?php echo $data['background-color'];?>>

<div style="display: none;">
    <div class="box-modal" id="exampleModal">
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <h3>Подпишитесь на рассылку новостей</h3>
        <form method="post" id="myForm">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input name="name" type="text" class="form-control" id="inputName" placeholder="Your name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-default">Send</button>
        </form>
    </div>
</div>

<nav class="navbar navbar-inverse navbar-fixed-top " <?php echo $data['menu_color'];?> >
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo SITE_NAME;
                                                    echo (isset($_SESSION['login'])) ? (" - ".$_SESSION['login']) : "";?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php if (!isset($_GET['route'])) echo "class=\"active\"";?>><a href="">Home</a></li>
                <li <?php if (isset($_GET['route']) && $_GET['route'] == "search/search/") echo "class=\"active\"";?>><a href="search/search/">Расширенный поиск</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Меню<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php echo $menu_content; ?>
                    </ul>
                </li>                        
                <?php if (isset($_SESSION['login']) and $_SESSION['login'] == ADMIN_LOGIN) { ?>
                    <li <?php if (isset($_GET['route']) && $_GET['route'] == "Admin/panel/") echo "class=\"active\"";?>><a href="admin/panel/">Админ-панель</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['login'])) { ?>
                <li <?php if (isset($_GET['route']) && $_GET['route'] == "users/logout/") echo "class=\"active\"";?>><a href="users/logout/">Logout</a></li>
                <?php } else { ?>
                <li <?php if (isset($_GET['route']) && $_GET['route'] == "users/login/") echo "class=\"active\"";?>><a href="users/login/">Login</a></li>
                <?php } ?>
                <li style="position: relative">
                    <div style="color: white; padding: 12px 10px 10px 50px;">
                        Поиск <input style="color: black; padding-left: 5px" type="text" id="search" placeholder="по тегу">
                    </div>
                    <div style="color: black; position: absolute; background-color: white; top: 38px; left: 94px;">
                        <ul class="search_result" id="search_result" style="list-style: none; padding: 0 0 0 5px; width: 188px;">

                        </ul>
                    </div>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<!-- template data -->

<div class="row ">
    <div class="col-xs-3 col-md-2 col-md-offset-1">
        <?php echo $left_content; ?>
    </div>

    <div class="col-xs-8 col-md-6 container" >
            <div class="starter-template" >
                <?php if($message) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $message ?>
                    </div>
                <?php } ?>
                <?php echo $content; ?>
            </div>
    </div>

    <div class="col-xs-3 col-md-2" >
        <?php echo $right_content; ?>
    </div>
</div>



</body>
</html>