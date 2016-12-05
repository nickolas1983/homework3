<h3>Расширенный поиск</h3>


<form method="post" style="text-align: left" enctype="multipart/form-data">
    <div style="width: 50%">
        <p><p>Катеuории</p>
        <select class="form-control" name="selectCategories[]" multiple>
            <?php foreach ($data['categories'] as $category){ ?>
                <option value="<?php echo $category['id'];?>"><?php echo $category['title'];?></option>
            <?php } ?>
        </select></p>
        <p><p>Теги</p>
        <select class="form-control" name="selectTags[]" multiple>
            <?php foreach ($data['tags'] as $tag ){ ?>
                <option value="<?php echo $tag['tag'];?>"><?php echo $tag['tag'];?></option>
            <?php } ?>
        </select></p>
    </div>
    <div style="width: 50%">
        <lable for="begin_date">Дата начала</lable>
        <input class="form-control" type="date" name="begin_date" id="begin_date"><br><br>
        <lable for="end_date">Дата конца</lable>
        <input class="form-control" type="date" name="end_date" id="end_date">
    </div>


    <input type="submit" value="OK"> 
</form>