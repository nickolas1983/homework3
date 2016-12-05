<div class="fotorama"
     data-width="800"
     data-height="600"
     data-nav="thumbs"
     data-autoplay="true">
    <?php foreach ($data['articles']['slider'] as $slide) {  ?>
        <img src="<?php echo 'public'.DS.'images'.DS.$slide['image'] ?>" data-caption="<?php echo $slide['title'] ?>">
    <?php } ?>
</div>
<div style="text-align: left;">
    <?php foreach ($data['categories'] as $category ) { ?>
        <h3><a href="article/categoryList/<?php echo $category['id'] ?>"><?php echo $category['title']?></a></h3>
        <?php  foreach ($data['articles'][$category['id']] as $article) {?>
            <p><a href="article/display/<?php echo $article['id'] ?>"><?php echo $article['title'];?></a></p>
        <?php } ?>
    <?php } ?>
</div>

<div style="text-align: left;">
        <h3 style="text-align: center;">Топ коментаноры</h3>
 
            <table>
                <tr>
                    <td style="width: 20%">№</td>
                    <td style="width: 50%">Коментатор</td>
                    <td style="width: 20%">Коментов</td>
                </tr>
                <?php  $i = 1;
                foreach ($data['commentators'] as $commentator) {?>
                <tr>
                    <td><span><?php echo $i++;?></span></td>
                    <td><a href="article/commentatorsList/<?php echo $commentator['id_user'] ?>"><?php echo $commentator['login'];?></a></td>
                    <td><?php echo $commentator['comments'] ?></td>
                </tr>
                <?php } ?>
            </table>
            <p></p>

</div>

<div style="text-align: left;">
    <h3 style="text-align: center;">Топ темы</h3>

    <table>
        <tr>
            <td style="width: 20%">№</td>
            <td style="width: 80%">Тема</td>
        </tr>
        <?php  $i = 1;
        foreach ($data['top_themes'] as $themes) {?>
            <tr>
                <td><span><?php echo $i++;?></span></td>
                <td><a href="article/display/<?php echo $themes['article_id'] ?>"><?php echo $themes['title'];?></a></td>
            </tr>
        <?php } ?>
    </table>
    <p></p>
</div>


