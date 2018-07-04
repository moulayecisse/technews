<?php
namespace App\Controller\Home;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Article;
use App\Service\Article\ArticleYamlProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Tests\Controller;


/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    /**
     * Page d'accueil de notre Site Internet
     * @param ArticleYamlProvider $yamlProvider
     * @return Response
     * @Route( path="/", name="home")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        return $this->render( 'controllers/index/index.html.twig' );
    }

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