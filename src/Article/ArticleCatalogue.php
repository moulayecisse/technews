<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:43
 */

namespace App\Article;


use App\Entity\Article;

class ArticleCatalogue implements ArticleCatalogueInterface, ArticleRepositoryInterface
{
    /**
     * @var ArticleAbstractSource[]
     */
    private $sources;

    public function addSource(ArticleAbstractSource $source)
    {
        $sources[] = $source;
    }

    public function getSources()
    {
        return $this->sources;
    }

    public function setSources($sources)
    {
        $this->sources = $sources;
    }

    public function find(int $id): ?Article
    {
        foreach ( $this->sources as $source )
        {
            $article = $source->find($id);
            if( $article !== null ) return $article;
        }

        return null;
    }

    public function findAll() : array
    {
        $articles = [];

        foreach ( $this->sources as $source )
        {
            $articles = array_merge($articles, $source->findAll());
        }

        return $articles;
    }

    public function findLastArticles($limit = null, $offset = null) : array
    {
        $articles = [];

        foreach ( $this->sources as $source )
        {
            $articles = array_merge($articles, $source->findLastArticles($limit, $offset));
        }

        usort(
            $articles,
            function ( $a, $b ) {
            return $a->getCreatedDate() > $b->getCreatedDate();
            }
        );

        return array_slice($articles, $offset, $limit);
    }

    public function findRelatedArticles($idArticle, $idCategory) : array
    {
        $articles = [];

        foreach ( $this->sources as $source )
        {
            $articles = array_merge($articles, $source->findRelatedArticles($idArticle, $idArticle));
        }
        
        return $articles;
    }

    public function findSpotlightArticles($limit = null, $offset = null) : array
    {
        $articles = [];

        foreach ( $this->sources as $source )
        {
            $articles = array_merge($articles, $source->findSpotlightArticles($limit, $offset));
        }

        return array_slice($articles, $offset, $limit);
    }

    public function findSpecialArticles($limit = null, $offset = null) : array
    {
        $articles = [];

        foreach ( $this->sources as $source )
        {
            $articles = array_merge($articles, $source->findSpotlightArticles($limit, $offset));
        }

        return array_slice($articles, $offset, $limit);
    }
}