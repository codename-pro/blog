<?php

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

abstract class AbstractController
{
    /** @var View */
    protected $view;

    /** @var User */
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByTokenI();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setVar('user', $this->user);
    }

}