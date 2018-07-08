<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 29/06/2018
 * Time: 15:43
 */

namespace App\Factory;


use App\Request\ArticleRequest;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use DateTime;

class ArticleFactory
{
    /**
     * @param \App\Request\ArticleRequest $articleRequest
     * @param Article|null $article
     * @return Article
     */
    public static function createFromArticleRequest( ArticleRequest $articleRequest, Article $article = null ) : Article
    {
        $article = $article ?? new Article();

        $article->setTitle( $articleRequest->getTitle() );
        $article->setSlug( $articleRequest->getSlug() );
        $article->setContent( $articleRequest->getContent() );
        $article->setFeaturedImage( $articleRequest->getFeaturedImage() );
        $article->setSpecial( $articleRequest->getSpecial() );
        $article->setSpotlight( $articleRequest->getSpotlight() );
        $article->setCreatedDate( $articleRequest->getCreatedDate() );
        $article->setCategory( $articleRequest->getCategory() );
        $article->setUser( $articleRequest->getUser() );

        return $article;
    }

    public static function createArticleFromDoctrine($doctrineArticle ) : Article
    {
        /**
         * @var Article $article
         * @var Article $doctrineArticle
         */
        $article = $doctrineArticle;

        $article->setFeaturedImage( '/images/product/' . $doctrineArticle->getFeaturedImage() );

        return $article;
    }
    public static function createArticleFromYAML($YAMLArticle ) : Article
    {
        $article = new Article();

        $user = new User();
        $user->setEmail( "yaml@yaml.com" );
        $user->setLastConnectionDate( DateTime::createFromFormat('Y-m-d H:m:s', 'now') );
        $user->setRegistrationDate( new DateTime() );
        $user->setFirstName( "YAML" );
        $user->setLastName( "YAML" );
        $user->setPassword( "YAML" );
        $user->setRoles( ["YAML"] );

        $category = new Category();
        $category->setSlug( "yaml" );
        $category->setName( "YAML" );

        $article->setID( $YAMLArticle->id ?? rand(1, 10000) );
        if( isset($YAMLArticle->title) ) $article->setTitle( $YAMLArticle->title );
        if( isset($YAMLArticle->slug) ) $article->setSlug( $YAMLArticle->slug );
        if( isset($YAMLArticle->content) ) $article->setContent( $YAMLArticle->content );
        if( isset($YAMLArticle->featuredImage) ) $article->setFeaturedImage( $YAMLArticle->featuredImage );
        if( isset($YAMLArticle->special) ) $article->setSpecial( $YAMLArticle->special );
        if( isset($YAMLArticle->spotlight) ) $article->setSpotlight( $YAMLArticle->spotlight );
        if( isset($YAMLArticle->createdDate) ) $article->setCreatedDate( $YAMLArticle->createdDate );
        $article->setCategory( $YAMLArticle->category ?? $category );
        $article->setUser( $YAMLArticle->user ?? $user );

        return $article;
    }


    public static function createArticlesFromYAML($YAMLArticles ) : array
    {
        $articles = array();

        foreach ( $YAMLArticles as $YAMLArticle ) $articles[] = self::createArticleFromYAML($YAMLArticle);


        return $articles;
    }

    public static function createArticleFromAPI($APIArticle ) : Article
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

    public static function createArticlesFromDoctrine($doctrineArticles ) : array
    {
        $articles = array();

        foreach ($doctrineArticles as $doctrineArticle ) $articles[] = self::createArticleFromDoctrine($doctrineArticle);


        return $articles;
    }

    public static function createArticlesFromAPI($APIArticles ) : array
    {
        $articles = array();

        foreach ($APIArticles as $APIArticle ) $articles[] = self::createArticleFromAPI($APIArticle);


        return $articles;
    }
}