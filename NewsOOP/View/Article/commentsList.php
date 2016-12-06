<div style="text-align: left">
    <h3><?php echo $data['comments_list'][0]['login'] ?></h3>



    <?php foreach ($data['comments_list'] as $comment) { ?>
        <div class="well well-small" style="border: solid lightgray 1px; margin-bottom: 5px; ">
            <p>Статья: <?php echo $comment['title'] ?> </p>
            <p>Комментарий: <?php echo $comment['comment']?></p>
            <p>Дата: <?php echo $comment['add_date']?></p>
        </div>
    <?php } ?>
</div>
<div style="margin: auto 0">

    <div id="pages" class="btn-group" role="group" aria-label="...">

        <a href="article/commentatorsList/<?php echo $data['comments_list'][0]['user_id'];?>"><button type="button" class="btn btn-default">1</button></a>

        <a><button type="button" id="show" class="btn btn-default">...</button></a>

        <?php
        $lastPage = $data['pagination']['lastPage'];
        if ($lastPage > 2) {
            for($i = 2; $i < $lastPage; $i++) {?>
                <a href="article/commentatorsList/<?php echo $data['comments_list'][0]['user_id'];?>/<?php echo $i;?>">
                    <button type="button" class="btn btn-default page" style="display: none;"><?php echo $i;?></button></a>
            <?php } }?>

        <a href="article/commentatorsList/<?php echo $data['comments_list'][0]['user_id'];?>/<?php if ($lastPage>1) echo $lastPage;?>"><button type="button" class="btn btn-default"><?php echo $lastPage;?></button></a>

    </div>
</div>