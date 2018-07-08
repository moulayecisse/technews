<?php
namespace App\Controller\Module;

use App\Service\ArticleCatalogue;
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
     * @var ArticleCatalogue $articleCatalogue
     */
    private $articleCatalogue;

    public function __construct( ArticleCatalogue $articleCatalogue )
    {
        $this->articleCatalogue = $articleCatalogue;
    }

    /**
     * Génération de la Sidebar
     * @return Response
     */
    public function sidebar()
    {
        $lastFiveArticles = $this->articleCatalogue->findLastArticles(5, 0);
        $specialArticles = $this->articleCatalogue->findSpecialArticles(5, 0);

        return $this->render(
            'components/_sidebar.html.twig',
            [
                'lastFiveArticles' => $lastFiveArticles,
                'specialArticles'  => $specialArticles,
            ]
        );
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
        $articles = $this->articleCatalogue->findSpecialArticles(5, 0);

        return $this->render('modules/_special_articles.twig', [ 'articles' => $articles ] );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function spotlight()
    {
        $articles = $this->articleCatalogue->findSpotlightArticles(5, 0);

        return $this->render('modules/_spotlight.html.twig', [ 'articles' => $articles ] );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function spotlightThumbs()
    {
        $articles = $this->articleCatalogue->findSpotlightArticles( 9, 3 );

        return $this->render('modules/_spotlight_thumbs.html.twig', [ 'articles' => $articles ] );
    }

    /**
     * Génération de la Mobile Menu
     */
    public function lastArticles()
    {
        $articles = $this->articleCatalogue->findLastArticles( 4, 0 );

        return $this->render('modules/_last_articles.html.twig', [ 'articles' => $articles ] );
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

    /**
     * Génération de la Mobile Menu
     */
    public function user()
    {
        return $this->render('modules/_user.html.twig');
    }
}