<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 15:24
 */

namespace App\Service\Source;


use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Asset\PackageInterface;
use Symfony\Component\Asset\Packages;

class ArticleDoctrineSource extends ArticleAbstractSource
{
    /**
     * @var ObjectRepository $repository
     */
    private $repository;

    /**
     * @var PackageInterface $package
     */
    private $package;

    public function __construct( ObjectManager  $objectManager, Packages $package)
    {
        $this->repository    = $objectManager->getRepository(Article::class);
        $this->package    = $package;
    }

    public function find(int $id): Article
    {
        return $this->createFromArray( $this->repository->find($id));
    }

    public function findAll( ) : array
    {
        $articles = $this->createFromCollection( $this->repository->findAll() );

        $articles = $this->createFromCollection( $this->repository->findSpotlightArticles( 5, 0 ));

        return $articles;
    }

    public function findLastArticles( int $limit = null, int $offset = null ) : array
    {

        return $this->createFromCollection( $this->repository->findLastArticles( $limit, $offset ) );
    }

    public function findRelatedArticles( int $articleId, int $categoryId) : array
    {
        return $this->createFromCollection( $this->repository->findRelatedArticles( $articleId, $categoryId ) );
    }

    public function findSpotlightArticles( int $limit = null, int $offset = null) : array
    {
        $articles = $this->createFromCollection( $this->repository->findSpotlightArticles( $limit, $offset ) );

        return $articles;
    }

    public function findSpecialArticles( int $limit = null, int $offset = null) : array
    {
        return $this->createFromCollection($this->repository->findSpecialArticles($limit, $limit));
    }

    /**
     * Retourne le nombre d'éléments de chaque source
     * @return int
     */
    public function count(): int
    {
        return $this->repository->findTotalArticles();
    }


    protected function createFromCollection(iterable $articles): iterable
    {
        foreach ( $articles as &$article )  $this->createFromArray($article);

        return $articles;
    }

    /**
     * @param Article $article
     * @return Article|null
     */
    protected function createFromArray(Article $article): ?Article
    {
//        $article->setId( $article->getId() );
//        $article->setTitle( $article->getTitle() );
//        $article->setSlug( $article->getSlug() );
//        $article->setContent( $article->getContent() );
        if( ! strpos($article->getFeaturedImage(), 'images/product/' ) ) $article->setFeaturedImage(  $this->package->getUrl( 'images/product/' . $article->getFeaturedImage()) );
//        $article->setSpecial( $article->getSpecial() );
//        $article->setSpotlight( $article->getSpotlight() );
//        $article->setCreatedDate( $article->getCreatedDate() );
//        $article->setCategory( $article->getCategory() );
//        $article->setUser( $article->getUser() );

        return $article;
    }
}