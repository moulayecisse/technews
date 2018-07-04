<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:33
 */

namespace App\Article;


use App\Entity\Article;

class ArticleAbstractSource implements ArticleRepositoryInterface
{
    private $mediator;

    public function setMediator( $mediator )
    {
        $this->mediator = $mediator;
    }

    public function find(int $id): Article
    {
        $article = new Article();

        // TODO: Implement find() method.

        return $article;
    }

    public function findAll() : array
    {
        return [];
    }

    public function findLastArticles($limit = null, $offset = null) : array
    {
        return [];
    }

    public function findRelatedArticles($idArticle, $idCategory) : array
    {
        return [];
    }

    public function findSpotlightArticles($limit = null, $offset = null) : array
    {
        return [];
    }

    public function findSpecialArticles($limit = null, $offset = null) : array
    {
        return [];
    }
}