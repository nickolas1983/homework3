<h3>Управление новостями</h3>

<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="add_article" value="1">
    <input type="hidden" name="MAX_FILE_SIZE" value = "<?php echo MAX_FILE_SIZE; ?>" />
    <h4>Добавить новость</h4>
    <table style="text-align: left">
        <tr>
            <td><label for="add_news" style="margin-right: 20px;">Заголовок</label></td>
            <td><input class="form-control" type="text" id="add_news" name="add_news"></td>
        </tr>
        <tr>
            <td><p>Катеuория</p></td>
            <td>
                <p><select class="form-control" name="selectCategory">
                    <?php foreach ($data['categories'] as $category){ ?>
                        <option class="form-control" value="<?php echo $category['id'];?>"><?php echo $category['title'];?></option>
                    <?php } ?>
                </select></p>
            </td>
        </tr>
        <tr>
            <td><label for="full_text">Текст статьи</label></td>
            <td><textarea class="form-control" id="full_text" name="full_text" cols="50" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>Изображение</td>
            <td><input class="form-control" type="file" placeholder="3.jpg" name="image"> </td>
        </tr>
        <tr>
            <td>Теги</td>
            <td><input class="form-control" type="text" placeholder="економіка, бджет, новий рік" name="meta_key"> </td>
        </tr>
        <tr>
            <td>Аналитическая статья?</td>
            <td><input class="form-control" type="checkbox" name="analytics" value="8"> </td>
        </tr>
        <tr>
            <td></td>
            <td><input class="btn btn-default" type="submit" value="Создать"></td>
        </tr>
    </table>
</form>