<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 29/06/2018
 * Time: 15:43
 */

namespace App\Article;


use App\Entity\Article;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\File;

class ArticleRequestFactory
{
    /**
     * @param Article $article
     * @param Packages $packages
     * @param String $article_image_path
     * @return ArticleRequest
     */
    public static function createFromArticle( Article $article, Packages $packages, string $article_image_path ) : ArticleRequest
    {
        $articleRequest = new ArticleRequest($article->getUser());

        $articleRequest->setId( $article->getId() );
        $articleRequest->setTitle( $article->getTitle() );
        $articleRequest->setSlug( $article->getSlug() );
        $articleRequest->setContent( $article->getContent() );
        $articleRequest->setFeaturedImage( new File( $article_image_path . '/' . $article->getFeaturedImage() ) );
        $articleRequest->setFeaturedImageUrl( $packages->getUrl('images/product/' . $article->getFeaturedImage()) );
        $articleRequest->setSpecial( $article->getSpecial() );
        $articleRequest->setSpotlight( $article->getSpotlight() );
        $articleRequest->setCreatedDate( $article->getCreatedDate() );
        $articleRequest->setCategory( $article->getCategory() );
        $articleRequest->setUser( $article->getUser() );

        return $articleRequest;
    }
}