<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:37
 */

namespace App\Article;


use App\Entity\Article;

interface ArticleRepositoryInterface
{
    public function find( int $id ) : Article;
    public function findAll();
    public function findLastFiveArticles( $limit = null, $offset = null );
    public function findRelatedArticles( $idArticle, $idCategory );
    public function findSpotlightArticles( $limit = null, $offset = null);
    public function findSpecialArticles( $limit = null, $offset = null);
}