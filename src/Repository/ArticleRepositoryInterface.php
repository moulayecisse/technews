<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:37
 */

namespace App\Repository;


use App\Entity\Article;

interface ArticleRepositoryInterface
{
    /**
     * @param int $id
     * @return Article|null
     */
    public function find( int $id ) : ?Article;

    /**
     * @return iterable
     */
    public function findAll() : iterable;

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return iterable
     */
    public function findLastArticles( int $limit = null, int $offset = null ) : iterable;

    /**
     * @param int $articleId
     * @param int $categoryId
     * @return iterable
     */
    public function findRelatedArticles(int $articleId, int $categoryId ) : iterable;

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return iterable
     */
    public function findSpotlightArticles( int $limit = null, int $offset = null) : iterable;

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return iterable
     */
    public function findSpecialArticles( int $limit = null, int $offset = null) : iterable;

    /**
     * Retourne le nombre d'éléments de chaque source
     * @return int
     */
    public function count() : int;
}