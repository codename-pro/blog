<?php include __DIR__ . '/../header.php'; ?>
<h1>Редактирование статей</h1>
<?php foreach ($articles as $article): ?>
    <h2><?= $article->getName() ?></h2>
    <p><?= $article->getText() ?></p>
    <a href="/www/articles/<?= $article->getId() ?>">Редактировать</a>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>
