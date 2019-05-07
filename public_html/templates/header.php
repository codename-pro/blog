<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Мой блог' ?></title>
    <link rel="stylesheet" href="/www/style.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?php if (!empty($user)): ?>
            Привет,  <?= $user->getNickname()?> | <a href="/www/users/logout">Выйти</a>
            <?php else: ?>
            <a href="/www/users/login">Войти</a> | <a href="/www/users/register">Регистрация</a>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>