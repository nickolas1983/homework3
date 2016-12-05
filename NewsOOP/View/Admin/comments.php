<div style="text-align: left">
    <h3>Утверждение комментариев</h3>
    <span>(кликнуть по комментарию что бы сделать доступным)</span>



    <?php foreach ($data['comments_list'] as $comment) { ?>
        <div class="check_comment  well well-small" style="border: solid lightgray 1px; margin-bottom: 5px;">
            <span style="display: none"><?php echo $comment['comment_id'] ?></span>
            <p>Статья: <?php echo $comment['title'] ?> </p>
            <p>Комментарий: <?php echo $comment['comment']." ".$comment['add_date']?></p>
            <?php if ($comment['visible']) { ?>
                <p class="visible" style="color: green">Видимый</p>
            <?php } else { ?>
                <p class="visible" style="color: red">Не видимый</p>
            <?php } ?>
        </div>
    <?php } ?>
</div>


<div style="margin: auto 0">

    <div id="pages" class="btn-group" role="group" aria-label="...">

        <a href="admin/comments/"><button type="button" class="btn btn-default">1</button></a>

        <a><button type="button" id="show" class="btn btn-default">...</button></a>

        <?php
        $lastPage = $data['pagination']['lastPage'];
        if ($lastPage > 2) {
            for($i = 2; $i < $lastPage; $i++) {?>
                <a href="admin/comments/<?php echo $i;?>">
                    <button type="button" class="btn btn-default page" style="display: none;"><?php echo $i;?></button></a>
            <?php } }?>

        <a href="admin/comments/<?php echo $lastPage;?>"><button type="button" class="btn btn-default"><?php echo $lastPage;?></button></a>

    </div>
</div>