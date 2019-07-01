<body>
    <header>
        <h1>Блог</h1>
    </header>
    <main>
        <?php foreach ($messages as $message):?>
            <div class="message">
                <p>Имя пользователя: <?=$message['author'];?></p>
                <p>Дата отправки сообщения: <?=date('H:i:s d.m.Y', $message['date']);?></p>
                <p>Текст сообщения: <?=$message['message'];?></p>
                <?php if (!empty($message['path_to_file'])):?>
                <p><img src="<?='/'.$message['path_to_file'];?>" alt="Здесь должна быть картинка" height="100"></p>
                <?php endif;?>
            </div>
        <?php endforeach;?>
        <?php require_once(ROOT.'/views/form.php');?>
    </main>
</body>