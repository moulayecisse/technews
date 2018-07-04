<?php

namespace App\Article;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
     * Récupère les 5 derniers article
     * @param null $limit
     * @param null $offset
     * @return mixed
     */
    public function findLastFiveArticles( $limit = null, $offset = null )
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findRelatedArticles($idArticle, $idCategory)
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

    public function findSpotlightArticles( $limit = null, $offset = null)
    {
        return $this->createQueryBuilder( 'a' )
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

    public function findSpecialArticles( $limit = null, $offset = null)
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
}
