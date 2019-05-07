<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminController extends AbstractController
{
    public function main() {
        if ($this->user->isAdmin()) {
            $this->view->renderHtml('admin/main.php');
        }
    }


    public function editArticles()
    {
        if ($this->user->isAdmin()) {
            $articles = Article::getLastEntities();
            $this->view->renderHtml('admin/articles.php', ['articles' => $articles]);
    }

    }

    public function editComments()
    {
        if ($this->user->isAdmin()) {
            $comments = Comment::getLastEntities();
            $this->view->renderHtml('admin/comments.php', ['comments' => $comments]);
        }
    }
}