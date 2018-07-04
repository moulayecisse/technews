<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 29/06/2018
 * Time: 15:31
 */

namespace App\Handler;


use App\Controller\HelperTrait;
use App\Entity\Article;
use App\Article\ArticleFactory;
use App\Article\ArticleRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleRequestHandler
{
    use HelperTrait;

    private $entityManager, $article_image_path, $package;

    /**
     * ArticleRequestHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param String $article_image_path
     * @param Packages $package
     */
    public function __construct(EntityManagerInterface $entityManager, String $article_image_path, Packages $package)
    {
        $this->entityManager = $entityManager;
        $this->article_image_path = $article_image_path;
        $this->package = $package;
    }

    /**
     * @param ArticleRequest $articleRequest
     * @return Article
     */
    public function handle( ArticleRequest $articleRequest ) : Article
    {
        # Traitement de l'upload de mon image
        /** @var UploadedFile $image */
        $image = $articleRequest->getFeaturedImage();

        # Génération du nom de l'image
        $fileName = $this->slugify( $articleRequest->getTitle() ) . '.' . $image->getExtension();

        # Deplacer l'image dans le répertoire dédié
        $image->move( $this->article_image_path, $fileName);

        # Assignation du nom de l'image téléchargé
        $articleRequest->setFeaturedImage($fileName);

        # Assignation du slug de l'article d'après le titre
        $articleRequest->setSlug($this->slugify($articleRequest->getTitle()));

        # Création d'un article
        $article = ArticleFactory::createFromArticleRequest($articleRequest);

        # On sauvegarde en BDD
        $this->entityManager->persist($article);
        $this->entityManager->flush();


        return $article;
    }

    /**
     * @return mixed
     */
    public function getArticleImagePath()
    {
        return $this->article_image_path;
    }

    /**
     * @return Packages
     */
    public function getPackage(): Packages
    {
        return $this->package;
    }
}