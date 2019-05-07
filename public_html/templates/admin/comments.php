<?php include __DIR__ . '/../header.php'; ?>

<h1>Редактирование комментариев</h1>
<?php foreach ($comments as $comment): ?>
    <p><?= $comment->getText() ?></p>
    <a href="/www/comments/<?= $comment->getId() ?>/edit">Редактировать</a>
    <hr>
<?php endforeach; ?>

<?php include __DIR__ . '/../footer.php'; ?>
