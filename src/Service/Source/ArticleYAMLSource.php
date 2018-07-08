<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 15:24
 */

namespace App\Service\Source;


use App\Service\Provider\ArticleYAMLProvider;
use App\Controller\HelperTrait;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use DateTime;
use Tightenco\Collect\Support\Collection;

//class ArticleYAMLSource extends ArticleAbstractSource
class ArticleYAMLSource
{
    use HelperTrait;

    /**
     * @var iterable
     */
    private $articles;

    public function __construct( ArticleYAMLProvider $articleYAMLProvider )
    {
        $this->articles = new Collection($articleYAMLProvider->getArticles());

        foreach ( $this->articles as &$article ) $article = $this->createFromArray($article);
    }

    public function find(int $id): Article
    {
        return $this->articles->firstWhere( 'id', $id );
    }

    public function findAll() : iterable
    {
        return $this->articles;
    }

    public function findLastArticles( int $limit = null, int $offset = null ) : iterable
    {
        return $this->articles->sortBy( 'creationDate' )->slice(-5);
    }

    public function findRelatedArticles( int $articleId, int $categoryId ) : iterable
    {
        return $this->articles;
    }

    public function findSpotlightArticles( int $limit = null, int $offset = null ) : iterable
    {
        return $this->articles;
    }

    public function findSpecialArticles( int $limit = null, int $offset = null ) : iterable
    {
        return $this->articles;
    }

    /**
     * Retourne le nombre d'éléments de chaque source
     * @return int
     */
    public function count(): int
    {
        return $this->count();
    }


    protected function createFromArray(iterable $YAMLArticle): ?Article
    {
        $YAMLArticle = (object) $YAMLArticle;
        $article = new Article();

        $user = new User();
        $user->setFirstName( $YAMLArticle->auteur['prenom'] );
        $user->setLastName( $YAMLArticle->auteur['nom'] );
        $user->setEmail( $YAMLArticle->auteur['email'] );

        $category = new Category();
        $category->setId( $YAMLArticle->categorie['id'] );
        $category->setSlug( $this->slugify($YAMLArticle->categorie['libelle']) );
        $category->setName( $YAMLArticle->categorie['libelle'] );

        $date = new DateTime();

        $article->setID( $YAMLArticle->id ?? rand(1, 10000) );
        $article->setTitle( $YAMLArticle->title ?? '');
        $article->setSlug( $this->slugify($article->getTitle()) );
        $article->setContent( $YAMLArticle->contenu ?? '');
        $article->setFeaturedImage( $YAMLArticle->featuredimage ?? '');
        $article->setSpecial( $YAMLArticle->special ?? '');
        $article->setSpotlight( $YAMLArticle->spotlight ?? '');
        $article->setCreatedDate( $date->setTimestamp($YAMLArticle->datecreation ?? 'now') );
        $article->setCategory( $category );
        $article->setUser( $user );

        return $article;
    }
}