<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getParsedText() ?></p>
    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
    <?php if ($user !== null && $user->isAdmin()): ?>
    <a href="/www/articles/<?= $article->getId() ?>/edit">Редактировать</a>
    <?php endif; ?>
    <div>
    </div>
    <?php if ($user !== null): ?>
    <div>
        <h2>Комментарии</h2>
        <form action="/www/articles/<?= $article->getId() ?>/comments" method="post">
            <label for="text">Добавить комментарий:</label><br>
            <textarea name="text" id="text" cols="30" rows="5"><?= $_POST['text'] ?? ''?></textarea><br>
            <br>
            <input type="submit" value="Отправить">
        </form>
    </div>
    <?php endif; ?>
    <hr>
       <?php foreach ($comments as $comment): ?>
        <div>
           <dl>
               <dt><b>Комментарий:</b></dt>
               <dt><?= $comment->getText() ?></dt>
           </dl>
            <?php if ($user !== null && $user->isAdmin()): ?>
            <a href="/www/comments/<?= $comment->getId() ?>/edit">Редактировать</a>
            <?php endif; ?>
        </div>
       <?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>