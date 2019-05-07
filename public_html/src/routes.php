<?php

return [
    '~^articles/(\d+)$~' => [\MyProject\Controllers\ArticlesController::class, 'view'],
    '~^articles/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'edit'],
    '~^articles/add$~' => [\MyProject\Controllers\ArticlesController::class, 'add'],
    '~^users/register$~' => [\MyProject\Controllers\UsersController::class, 'signUp'],
    '~^articles/(\d+)/delete$~' => [\MyProject\Controllers\ArticlesController::class, 'delete'],
    '~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
    '~^users/login~' => [\MyProject\Controllers\UsersController::class, 'login'],
    '~^users/logout~' => [\MyProject\Controllers\UsersController::class, 'logout'],
    '~^articles/(\d+)/comments$~' => [\MyProject\Controllers\ArticlesController::class, 'addComment'],
    '~^comments/(\d+)/edit$~' => [\MyProject\Controllers\ArticlesController::class, 'editComment'],
    '~^admin$~' => [\MyProject\Controllers\AdminController::class, 'main'],
    '~^admin/articles$~' => [\MyProject\Controllers\AdminController::class, 'editArticles'],
    '~^admin/comments$~' => [\MyProject\Controllers\AdminController::class, 'editComments'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main'],
];