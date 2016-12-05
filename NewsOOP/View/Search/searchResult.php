<h3>Результаты поиска</h3>
<div style="text-align: left">
    <?php foreach ($data['articles'] as $article ){ ?>
        <a href="article/display/<?php echo $article['id'] ?>"><p><?php echo $article['title'] ?></p></a>
    <?php } ?>
</div> 


