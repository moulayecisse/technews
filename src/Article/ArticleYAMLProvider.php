<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 26/06/2018
 * Time: 10:19
 */

namespace App\Article;

use App\Entity\Article;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ArticleYAMLProvider implements ArticleRepositoryInterface
{
    function findAll() : array
    {
        try {
            return Yaml::parseFile(__DIR__ . '/articles.yaml')['data'];
//            return Yaml::parseFile('articles.yaml')['data'];
        } catch (ParseException $parseException)
        {
            printf( 'Unable to parse the YAML string: %s', $parseException->getMessage() );
        }

        return [];
    }

    function find( int $id ) : ?Article
    {
        $articles = $this->findAll();

        foreach ( $articles as $article ) if( $article->id = $id ) return $article;

        return null;
    }

    public function findLastArticles($limit = null, $offset = null) : array
    {
        // TODO: Implement findLastFiveArticles() method.
    }

    public function findRelatedArticles($idArticle, $idCategory) : array
    {
        // TODO: Implement findRelatedArticles() method.
    }

    public function findSpotlightArticles($limit = null, $offset = null) : array
    {
        // TODO: Implement findSpotlightArticles() method.
    }

    public function findSpecialArticles($limit = null, $offset = null) : array
    {
        // TODO: Implement findSpecialArticles() method.
    }
}