<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 15:24
 */

namespace App\Service\Source;


use App\Entity\User;
use App\Service\Provider\ArticleAPIProvider;
use App\Entity\Article;
use DateTime;

class ArticleAPISource
//class ArticleAPISource extends ArticleAbstractSource
{
    /**
     * @var \App\Service\Provider\ArticleAPIProvider $articleAPIProvider
     */
    private $articleAPIProvider;

    public function __construct(ArticleAPIProvider $articleAPIProvider )
    {
        $this->articleAPIProvider = $articleAPIProvider;
    }

    public function find(int $id): Article
    {
        dump($this->articleAPIProvider->find($id));

        return $this->articleAPIProvider->find($id);
    }

    public function findAll() : array
    {
        dump($this->articleAPIProvider->findAll());

        return $this->createFromCollection($this->articleAPIProvider->findAll());
    }

    public function findLastArticles( int $limit = null, int $offset = null ) : array
    {
        return $this->createFromCollection($this->articleAPIProvider->findAll());
    }

    public function findRelatedArticles( int $articleId, int $categoryId ) : array
    {
        return $this->createFromCollection($this->articleAPIProvider->findAll());
    }

    public function findSpotlightArticles( int $limit = null, int $offset = null ) : array
    {
        return $this->createFromCollection($this->articleAPIProvider->findAll());
    }

    public function findSpecialArticles( int $limit = null, int $offset = null ) : array
    {
        return $this->createFromCollection($this->articleAPIProvider->findAll());
    }

    /**
     * Retourne le nombre d'éléments de chaque source
     * @return int
     */
    public function count(): int
    {
        return $this->count();
    }

    protected function createFromCollection(iterable $articles): iterable
    {
        foreach ( $articles as &$article ) $article = $this->createFromArray($article);

        return $articles;
    }

    protected function createFromArray(iterable $article): ?Article
    {
        $article = new Article();

        $user = new User();
        $user->setEmail( "api@api.com" );
        $user->setLastConnectionDate( DateTime::createFromFormat('Y-m-d H:m:s', 'now') );
        $user->setRegistrationDate( new DateTime() );
        $user->setFirstName( "API" );
        $user->setLastName( "API" );
        $user->setPassword( "API" );
        $user->setRoles( ["API"] );

        $category = new Category();
        $category->setSlug( "api" );
        $category->setName( "API" );

//        $date = new DateTime();
//        $date->setTimestamp($YAMLArticle->datecreation ?? 'now')

        $article->setID( $APIArticle->id ?? rand(1, 10000) );
        if( isset($APIArticle->id) ) $article->setTitle( $APIArticle->id );
        if( isset($APIArticle->title) ) $article->setTitle( $APIArticle->title );
        $article->setSlug( $APIArticle->url ?? $article->getId() );
        if( isset($APIArticle->description) ) $article->setContent( $APIArticle->description );
        $article->setFeaturedImage( $APIArticle->urlToImage ?? 'http://via.placeholder.com/350x150' );
        if( isset($APIArticle->special) ) $article->setSpecial( $APIArticle->special );
        if( isset($APIArticle->spotlight) ) $article->setSpotlight( $APIArticle->spotlight );
        if( isset($APIArticle->publishedAt) ) $article->setCreatedDate( $APIArticle->publishedAt );
        $article->setCategory( $APIArticle->category ?? $category );
        $article->setUser( $APIArticle->user ?? $user );

        return $article;
    }
}