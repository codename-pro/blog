<?php include __DIR__ . '/../header.php'; ?>
<form action="/www/comments/<?= $comment->getId() ?>/edit" method="post">
    <label for="text">Текст комментария</label><br>
    <textarea name="text" id="text" cols="80" rows="10"><?= $_POST['text'] ?? $comment->getText() ?></textarea><br>
    <br>
    <input type="submit" value="Обновить">
</form>
<?php include __DIR__ . '/../footer.php'; ?>
