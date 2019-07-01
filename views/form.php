<div>
    <?php if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])):?>
    <ul>
        <?php foreach ($_SESSION['errors'] as $error):?>
        <li><?=$error;?></li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
    <form action="/send" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Форма для отправки сообщения</legend>
            <p><input type="text" name="author" placeholder="Введите имя"></p>
            <p><textarea name="message" placeholder="Введите сообщение"></textarea></p>
            <p><input type="file" name="file" accept="image/*"></p>
            <p><input type="submit" name="submit" value="Отправить сообщение"></p>
        </fieldset>
    </form>
</div>