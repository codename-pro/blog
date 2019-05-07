<?php

namespace MyProject\Models\Comments;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Models\Articles\Article;

class Comment extends ActiveRecordEntity
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $authorId;

    /** @var int */
    protected $articleId;

    /** @var string */
    protected $text;

    /** @var string */
    protected $createdAt;

    /** @return void */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setArticleId(Article $artId): void
    {
        $this->articleId = $artId->getId();
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }

    public function getAuthor(): int
    {
        return $this->authorId;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }
    /**
     * @param array $fields
     * @param User $author
     * @return Comment
     */
    public static function createCommentary(array $fields, User $author, Article $articleId): Comment
    {
        $comment = new Comment();

        $comment->setAuthor($author);
        $comment->setText($fields['text']);
        $comment->setArticleId($articleId);

        $comment->save();

        return $comment;
    }

    public function updateCommentary(array $fields): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }

        $this->setText($fields['text']);

        $this->save();

        return $this;
    }

}