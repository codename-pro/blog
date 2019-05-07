<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\ForbiddenException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class ArticlesController extends AbstractController
{

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);
        $comments = Comment::findByColumn('article_id', $articleId);
        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('articles/view.php', ['article' => $article, 'comments' => $comments]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {

            if (!$this->user->isAdmin()) {
                throw new ForbiddenException('Только пользователь с правами администратора может редактировать статьи');
            }

            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /www/articles/' . $article->getId(), true, 302);
            exit;
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()){
            throw new ForbiddenException('Только пользователь с правами администратора может создавать статьи');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /www/articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article) {
            $article->delete();
        } else {
            $this->view->renderHtml('errors/NotFound.php', [], 404);
            return;
        }

        var_dump($article);
    }

    public function addComment(int $articledId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        $artId = Article::getById($articledId);
        if (!empty($_POST)) {
            try {
                $comment = Comment::createCommentary($_POST, $this->user, $artId);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/view.php', ['error' => $e->getMessage(), 'article' => $article, 'comments' => $comments]);
                return;
            }

            header('Location: /www/articles/' . $articledId, true, 302);
            exit();
        }

    }

    public function editComment(int $commentInt): void
    {
        $comment = Comment::getById($commentInt);

        if ($comment === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {

            if (($this->user->isAdmin()) && ($comment->getAuthor() === $this->user->getId())) {
                $comment->updateCommentary($_POST);
            }

            header('Location: /www/articles/' . $comment->getArticleId(), true, 302);
            exit();
        }


        $this->view->renderHtml('comments/edit.php', ['comment' => $comment]);
    }
}