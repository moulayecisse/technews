<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 04/07/2018
 * Time: 15:24
 */

namespace App\Article;


use App\Entity\Article;

class ArticleYAMLSource extends ArticleAbstractSource
{
    /**
     * @var ArticleYAMLProvider $entityManager
     */
    private $articleYAMLProvider;

    public function __construct( ArticleYAMLProvider $articleYAMLProvider )
    {
        $this->articleYAMLProvider = $articleYAMLProvider;
    }

    public function find(int $id): Article
    {
        return $this->articleYAMLProvider->find($id);
    }

    public function findAll() : array
    {
        return $this->articleYAMLProvider->findAll();
    }
//
//    public function findLastArticles( $limit = null, $offset = null ) : array
//    {
//        return $this->articleYAMLProvider->findAll();
//    }
//
//    public function findRelatedArticles( $idArticle, $idCategory ) : array
//    {
//        return $this->articleYAMLProvider->findAll();
//    }
//
//    public function findSpotlightArticles( $limit = null, $offset = null ) : array
//    {
//        return $this->articleYAMLProvider->findAll();
//    }
//
//    public function findSpecialArticles( $limit = null, $offset = null ) : array
//    {
//        return $this->articleYAMLProvider->findAll();
//    }
}