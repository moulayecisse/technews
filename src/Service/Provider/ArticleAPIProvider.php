<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 26/06/2018
 * Time: 10:19
 */

namespace App\Service\Provider;

use App\Factory\ArticleFactory;
use App\Repository\ArticleRepositoryInterface;
use App\Entity\Article;
use Tightenco\Collect\Support\Collection;

class ArticleAPIProvider implements ArticleRepositoryInterface
{
    const API_KEY = '9fcf6822596c484d8ecf63cfa2420199';
    const API_URL = 'https://newsapi.org/v2/everything?country=us';

    public function getFromAPI()
    {

    }
    function findAll() : iterable
    {
        $url = self::API_URL . '&apiKey=' . self::API_KEY;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        return  (array) json_decode($result);
    }

    function find( int $id ) : ?Article
    {
        $articles = $this->findAll();

        foreach ( $articles as $article ) if( $article->id = $id )
            return $article;

        return null;
    }

    public function findLastArticles( int $limit = null, int $offset = null) : array
    {
        return $articles = $this->findAll();
    }

    public function findRelatedArticles( int $articleId, int $categoryId) : array
    {
        return $articles = $this->findAll();
    }

    public function findSpotlightArticles( int $limit = null, int $offset = null) : array
    {
        return $articles = $this->findAll();
    }

    public function findSpecialArticles( int $limit = null, int $offset = null) : array
    {
        return $articles = $this->findAll();
    }

    /**
     * Retourne le nombre d'éléments de chaque source
     * @return int
     */
    public function count(): int
    {
        return $this->count();
    }
}