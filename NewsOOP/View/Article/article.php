<div id="article" style="text-align: left;" >
    <h3><?php echo $data['article']['title'] ?></h3>
    <p style="text-align: right ">Now watching article <span id="visitors"> 111 </span> visitors</p>
    <div style="float: left; margin-right: 10px; margin-bottom: 10px;"><img style="width: 300px" src="<?php echo 'public'.DS.'images'.DS.$data['article']['image'] ?>"></div>
    <p><?php echo $data['article']['full_text'] ?></p>
    <?php foreach ($data['article']['tags'] as $tag){ ?>
        <a href="article/tagList/<?php echo trim($tag);?>"><?php echo trim($tag);?></a>
    <?php } ?>
    <p style="text-align: right " id="viewed">Viewed times</p>
    <span style="display: none" id="id"><?php echo $data['article']['id'] ?></span>
</div>
<div id = "comments" style="text-align: left; clear: both;">
    <h3>Комментарии</h3>
    <?php if (isset($_SESSION['login'])) { ?>
        <textarea class="form-control" name="comment" id="comment" cols="30" rows="3" placeholder="Ваш комментарий"></textarea>
        <div style="text-align: right"><button id="save_comment" class="btn btn-default">Сохранить</button></div>
    <?php } else { ?>
        <p><a href="users/login/">Авторизируйтесь</a> для того что бы оставить комментарий</p>
    <?php } ?>

    <div style="text-align: ">
        <h4>Топ коменты</h4>
        <?php foreach ($data['top_comments'] as $top_comment){ ?>
            <p class="well well-small"><b><?php echo $top_comment['login'] ?> :</b> <span><?php echo $top_comment['comment'] ?></span> <span style="display: block; width: auto ; text-align: right; font-weight: bold; color: green"><?php echo "+".$top_comment['rate'] ?></span> </p>
        <?php } ?>
    </div>

    <h4>Комментарии</h4>
    <ul id="comments_return" style="list-style: none">
        <?php echo $data['comments']['html']; ?>
    </ul>
</div>
