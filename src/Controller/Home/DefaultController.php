<?php
namespace App\Controller\Home;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    /**
     * Page d'accueil de notre Site Internet
     * @return Response
     * @Route( path="/", name="home")
     */
    public function index()
    {
        return $this->render( 'controllers/index/index.html.twig' );
    }

    /**
     * Génération de la Sidebar
     */
    public function sidebar()
    {
        # Récupération du repository doctrine
        $repository = $this->getDoctrine()->getRepository(Article::class);

        # Récupération des 5 derniers articles
        $lastFiveArticles = $repository->findLastArticles();

        # Récupération des articles à la position "special"
        $specialArticles = $repository->findSpecialArticles();

        $this->view                           = 'components/_sidebar.html.twig';
        $this->parameters['lastFiveArticles'] = $lastFiveArticles;
        $this->parameters['specialArticles']  = $specialArticles;

        return $this->render( $this->view, $this->parameters );
    }
}