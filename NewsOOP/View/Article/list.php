<div style="text-align: left">
    <h3><?php echo $data['category']['description'] ?></h3>
    <?php foreach ($data['articles'] as $article) { ?>
        <a href="article/display/<?php echo $article['id'] ?>"><p><?php echo $article['title'] ?></p></a>
    <?php } ?>
</div>
<div style="margin: auto 0">
    
    <div id="pages" class="btn-group" role="group" aria-label="...">
        
        <a href="article/categoryList/<?php echo $data['category']['id'];?>/1"><button type="button" class="btn btn-default">1</button></a>
        
        <a><button type="button" id="show" class="btn btn-default">...</button></a>
        
        <?php
        $lastPage = $data['pagination']['lastPage'];
        if ($lastPage > 2) {
            for($i = 2; $i < $lastPage; $i++) {?>
                <a href="article/categoryList/<?php echo $data['category']['id'];?>/<?php echo $i;?>">
                    <button type="button" class="btn btn-default page" style="display: none;"><?php echo $i;?></button></a>
            <?php } }?>
        
        <a href="article/categoryList/<?php echo $data['category']['id'];?>/<?php echo $lastPage;?>"><button type="button" class="btn btn-default"><?php echo $lastPage;?></button></a>
        
    </div>
</div> 

