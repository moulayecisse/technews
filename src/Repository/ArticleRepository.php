<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed
     */
    public function findLastArticles( int $limit = null, int $offset = null )
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param int $idArticle
     * @param int $idCategory
     * @return mixed
     */
    public function findRelatedArticles( int $idArticle, int $idCategory)
    {
        return $this->createQueryBuilder( 'a' )
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

    /**
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function findSpotlightArticles( int $limit = null, int $offset = null)
    {
        return $this->createQueryBuilder( 'a' )
            ->where('a.spotlight = 1')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults( $limit )
            ->setFirstResult( $offset )
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function findSpecialArticles( int $limit = null, int $offset = null)
    {
        return $this->createQueryBuilder( 'a' )
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

    /**
     * @return int
     */
    public function findTotalArticles() : int
    {
        try
        {
            return
                $this->createQueryBuilder( 'a' )
                    ->select( 'COUNT(a)' )
                    ->getQuery()
                    ->getSingleScalarResult();
        } catch ( NonUniqueResultException $nonUniqueResultException )
        {
            return 0;
        }
    }
}
