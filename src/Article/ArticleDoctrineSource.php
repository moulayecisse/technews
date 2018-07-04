<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 04/07/2018
 * Time: 15:24
 */

namespace App\Article;


use App\Entity\Article;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ArticleDoctrineSource extends ArticleAbstractSource
{
    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;
    private $repository;

    public function __construct( EntityManagerInterface $entityManager )
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Article::class);
    }

    public function find(int $id): Article
    {
        return $this->repository->find(Article::class, $id);
    }

    public function findAll( ) : array
    {
        return $this->repository->findAll();
    }

    public function findLastArticles( $limit = null, $offset = null ) : array
    {

        return $this->repository->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findRelatedArticles($idArticle, $idCategory) : array
    {
        return $this->repository->createQueryBuilder( 'a' )
            # Where pour la catégorie
            ->where('a.category = :category_id')
            ->setParameter('category_id', $idCategory)

            # Where pour l'article
            ->andWhere('a.id != :article_id')
            ->setParameter('article_id', $idArticle)

            # Par ordre décroissant
            ->orderBy('a.id', 'DESC')

            # Maximum 3
            ->setMaxResults(3)

            # On finalise
            ->getQuery()
            ->getResult()
            ;
    }

    public function findSpotlightArticles( $limit = null, $offset = null) : array
    {
        return $this->repository->createQueryBuilder( 'a' )
            # Where pour la catégorie
            ->where('a.spotlight = 1')

            ->orderBy('a.id', 'DESC')

            # Maximum 3
            ->setMaxResults( $limit )

            # Maximum 3
            ->setFirstResult( $offset )

            # On finalise
            ->getQuery()
            ->getResult()
            ;
    }

    public function findSpecialArticles( $limit = null, $offset = null) : array
    {
        return $this->repository->createQueryBuilder( 'a' )
            # Where pour la catégorie
            ->where('a.special = 1')

            ->orderBy('a.id', 'DESC')

            # Maximum 3
            ->setMaxResults( $limit )

            # Maximum 3
            ->setFirstResult( $offset )

            # On finalise
            ->getQuery()
            ->getResult()
            ;
    }

}