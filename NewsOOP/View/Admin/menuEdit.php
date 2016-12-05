<h3>Управление вложеным меню</h3>

<form action="" method="post">
    <input type="hidden" name="add_article" value="1">
    <h4>Добавить пункт меню</h4>
    <table style="text-align: left">
        <tr>
            <td><label for="add_point" style="margin-right: 20px;">Название пункта меню</label></td>
            <td><input class="form-control" type="text" id="add_point" name="add_point"></td>
        </tr>
        <tr>
            <td><p>Родительский пункт меню</p></td>
            <td>
                <p><select class="form-control" name="parent_id">
                        <option class="form-control" value="">""</option>
                    <?php foreach ($data['menu'] as $item){ ?>
                        <option class="form-control" value="<?php echo $item['id'];?>"><?php echo $item['text'];?></option>
                    <?php } ?>
                </select></p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input class="btn btn-default" type="submit" value="Создать"></td>
        </tr>
    </table>
</form>