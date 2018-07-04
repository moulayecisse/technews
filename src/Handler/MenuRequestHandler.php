<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 02/07/2018
 * Time: 07:52
 */

namespace App\Handler;


use App\Controller\HelperTrait;
use App\Entity\Menu;
use App\Factory\MenuFactory;
use App\Request\MenuRequest;
use Doctrine\ORM\EntityManagerInterface;

class MenuRequestHandler
{
    use HelperTrait;

    private $entityManager;

    /**
     * ArticleRequestHandler constructor.
     * @param EntityManagerInterface $entityManager
     * @param $article_image_path
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle( MenuRequest $menuRequest ) : Menu
    {
        $menuRequest->setSlug( $this->slugify($menuRequest->getName()) );

        $menu = MenuFactory::createFromMenuRequest( $menuRequest );

        # On sauvegarde en BDD
        $this->entityManager->persist($menu);
        $this->entityManager->flush();

        return $menu;
    }
}