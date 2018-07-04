<?php
namespace App\Controller\Module;

use App\Controller\BaseController;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ModuleController
 * @package App\Controller
 */
class ModuleController extends BaseController
{
    /**
     * Génération de la Sidebar
     * @param Article|null $article
     * @return Response
     */
    public function sidebar( Article $article = null )
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
        $this->parameters['article']  = $article;

        return $this->render( $this->view, $this->parameters );
    }

    /**
     * Génération de la Sidebar
     */
    public function logo()
    {
        return $this->render( 'modules/_logo.html.twig');
    }

    /**
     * Génération de la Sidebar
     */
    public function logoFooter()
    {
        return $this->render( 'modules/_logo_footer.html.twig');
    }

    /**
     * Génération de la Menu
     * @param string $route
     * @param array $route_params
     * @return Response
     */
    public function menu($route = '', $route_params = array())
    {
        return $this->render(
            'modules/_menu.html.twig',
            [
                'categories' => $this->getDoctrine()->getRepository(Category::class)->findAll(),
                'route' => $route,
                'route_params' => $route_params,
            ]
        );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function mobileMenu()
    {
        return $this->render( 'modules/_mobile_menu.html.twig', [ 'categories' => [] ] );
    }

    public function specialArticles()
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepository->findSpecialArticles(1);

        return $this->render('modules/_special_articles.twig', [ 'articles' => $articles ] );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function spotlight()
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $spotlightArticles = $articleRepository->findSpotlightArticles(3);

        return $this->render('modules/_spotlight.html.twig', [ 'spotlightArticles' => $spotlightArticles ] );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function spotlightThumbs()
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $spotlightArticles = $articleRepository->findSpotlightArticles( 9, 3 );

        return $this->render('modules/_spotlight_thumbs.html.twig', [ 'spotlightArticles' => $spotlightArticles ] );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function lastArticles()
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $spotlightArticles = $articleRepository->findLastFiveArticles( 4 );

        return $this->render('modules/_last_articles.html.twig', [ 'spotlightArticles' => $spotlightArticles ] );
    }

    public function newsletter()
    {
        return $this->render('modules/_newsletter.html.twig' );
    }

    public function followUs()
    {
        return $this->render('modules/_follow_us.html.twig' );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function categories()
    {
        return $this->render('modules/_categories.html.twig', [ 'categories' => [] ]);
    }

    /**
     * Génération de la Mobile Menu
     */
    public function copyrights()
    {
        return $this->render('modules/_copyrights.html.twig');
    }

    /**
     * Génération de la Mobile Menu
     */
    public function socialMedias()
    {
        return $this->render('modules/_social_medias.html.twig');
    }

    /**
     * Génération de la Mobile Menu
     */
    public function tags()
    {
        return $this->render('modules/_tags.html.twig');
    }

    /**
     * Génération de la Mobile Menu
     */
    public function presentation()
    {
        return $this->render('modules/_presentation.html.twig');
    }
}