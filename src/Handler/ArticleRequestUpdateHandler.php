<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 03/07/2018
 * Time: 09:54
 */

namespace App\Handler;


use App\Controller\HelperTrait;
use App\Entity\Article;
use App\Article\ArticleFactory;
use App\Article\ArticleRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleRequestUpdateHandler
{
    use HelperTrait;

    private $article_image_path, $entityManager;

//    public function __construct( ObjectManager $objectManager, string $article_image_path )
    public function __construct( EntityManagerInterface $entityManager, string $article_image_path )
    {
        $this->entityManager = $entityManager;
        $this->article_image_path = $article_image_path;

    }

    /**
     * @param ArticleRequest $articleRequest
     * @param Article $article
     * @return Article
     */
    public function handle( ArticleRequest $articleRequest, Article $article ) : Article
    {
        # Traitement de l'upload de mon image
        /** @var UploadedFile $image */
        $image = $articleRequest->getFeaturedImage();

        /**
         * Todo : Pensez à supprimer l'ancienne image sur FTP
         */
        if( null !== $image )
        {
            # Génération du nom de l'image
            $fileName = $this->slugify( $articleRequest->getTitle() ) . '.' . $image->getExtension();

            # Deplacer l'image dans le répertoire dédié
            $image->move( $this->article_image_path, $fileName);

            # Assignation du nom de l'image téléchargé
            $articleRequest->setFeaturedImage($fileName);
        } else
        {
            $articleRequest->setFeaturedImage( $article->getFeaturedImage() );
        }

        # Assignation du slug de l'article d'après le titre
        $articleRequest->setSlug($this->slugify($articleRequest->getTitle()));

        # Création d'un article
        $article = ArticleFactory::createFromArticleRequest($articleRequest, $article);

        # On sauvegarde en BDD
        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }

}