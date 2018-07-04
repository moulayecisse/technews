<?php
namespace App\Controller\Component;

use App\Controller\BaseController;
use App\Entity\Article;

/**
 * Class ComponentController
 * @package App\Controller
 */
class ComponentController extends BaseController
{
    /**
     * Génération de la Sidebar
     */
    public function sidebar()
    {
        # Récupération du répository doctrine
        $repository = $this->getDoctrine()->getRepository(Article::class);

        # Récupération des 5 derniers articles
        $lastFiveArticles = $repository->findLastFiveArticles();

        # Récupération des articles à la position "special"
        $specialArticles = $repository->findSpecialArticles();

        $this->view                           = 'components/_sidebar.html.twig';
        $this->parameters['lastFiveArticles'] = $lastFiveArticles;
        $this->parameters['specialArticles']  = $specialArticles;

        return $this->render( $this->view, $this->parameters );
    }
}