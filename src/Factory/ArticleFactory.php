<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 29/06/2018
 * Time: 15:43
 */

namespace App\Factory;


use App\Entity\Article;
use App\Request\ArticleRequest;

class ArticleFactory
{
    /**
     * @param ArticleRequest $articleRequest
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
}