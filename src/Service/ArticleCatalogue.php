<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:43
 */

namespace App\Service;


use App\Service\Source\ArticleAbstractSource;
use App\Entity\Article;
use App\Exception\DuplicateCatalogueArticleException;
use Tightenco\Collect\Support\Collection;

class ArticleCatalogue implements ArticleCatalogueInterface
{
    /**
     * @var iterable $sources ArticleAbstractSource
     */
    private $sources;

    /**
     * @param ArticleAbstractSource $source
     */
    public function addSource(ArticleAbstractSource $source) : void
    {
        $this->sources[] = $source;
    }

    public function getSources() : iterable
    {
        return $this->sources;
    }

    public function setSources( iterable $sources ) : void
    {
        $this->sources = $sources;
    }

    public function find(int $id): ?Article
    {
        $articles = new Collection();

        /**
         * @var ArticleAbstractSource $source
         */
        foreach ( $this->sources as $source )
        {
            $article = $source->find($id);
            if( $article !== null ) $articles[] = $article;

        }

        if( $articles->count() > 1 )
        {
            throw new DuplicateCatalogueArticleException
            (
                sprintf
                (
                    'Return value of %s cannot return more than one record on line %s',
                    get_class($this) . '::' . __FUNCTION__ . '()', __LINE__
                )
            );
        }

        return $articles->pop();
    }

    public function findAll() : iterable
    {
        $articles = [];

        foreach ( $this->sources as $source )
        {

            $articles = array_merge($articles, $source->findAll());
        }

        return $articles;
    }

    public function findLastArticles( int $limit = null, int $offset = null) : iterable
    {
        $articles = new Collection();

        /**
         * @var ArticleAbstractSource $source
         */
        foreach ( $this->sources as $source )
        {
            $articles = $articles->merge($source->findLastArticles($limit, $offset));
        }

        $articles->sort(function ( $a, $b ) { return $a->getCreatedDate() > $b->getCreatedDate(); });

        return $articles->slice( $offset, $limit );
    }

    public function findRelatedArticles(int $articleId, int $categoryId) : iterable
    {
        $articles = new Collection();

        /**
         * @var ArticleAbstractSource $source
         */
        foreach ( $this->sources as $source )
        {
            $articles = $articles->merge($source->findRelatedArticles($articleId, $articleId));
        }
        
        return $articles;
    }

    public function findSpotlightArticles( int $limit = null, int $offset = null) : iterable
    {
        $articles = new Collection();

        /**
         * @var ArticleAbstractSource $source
         */
        foreach ( $this->sources as $source )
        {
            $articles = $articles->merge($source->findSpotlightArticles($limit, $offset));
        }

        return $articles;
    }

    public function findSpecialArticles( int $limit = null, int $offset = null ) : iterable
    {
        $articles = new Collection();

        /**
         * @var ArticleAbstractSource $source
         */
        foreach ( $this->sources as $source )
        {
            $articles = $articles->merge($source->findSpecialArticles($limit, $offset));
        }

        return $articles;
    }

    /**
     * Retourne le nombre d'éléments de chaque source
     * @return int
     */
    public function count(): int
    {
        return $this->count();
    }

    public function iterateOverSources( string $functionToCall ) : iterable
    {
        $articles = new Collection();

        foreach ( $this->sources as $source )
        {
            foreach ( $source->$functionToCall() as $article )
            {
                $articles[] = $article;
            }
        }

        return $articles;
    }
}