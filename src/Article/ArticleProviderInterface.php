<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 04/07/2018
 * Time: 11:57
 */

namespace App\Article;


use App\Entity\Article;

interface ArticleProviderInterface
{
    public function getArticle( $id ) : Article;
    public function getArticles( ) : ArticleCollection;
}