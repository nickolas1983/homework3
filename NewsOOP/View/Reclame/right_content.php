<h3 style="text-align: center">Реклама</h3>

<?php foreach ($data['reclames'] as $key => $baner) {
    if ($key%2 != 0){
        ?>
        <div class="reclame well well-small" style="border: solid 1px lightgrey; height: 100px; padding: 10px; margin-bottom: 10px;"
             data-placement="left" data-toggle="tooltip" title="Купон на скидку - Примените и получите 10% скидки">
            <p><?php echo $baner['title'] ?></p>
            <p class="price" ><?php echo $baner['price'] ?></p>
            <p><?php echo $baner['firm'] ?></p>
        </div>
    <?php }} ?>
