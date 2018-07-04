<?php
namespace App\Controller\Category;

use App\Controller\BaseController;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller\Category
 * @Route("/admin/post")
 */
class CategoryController extends BaseController
{
    /**
     * Affiche les category d'une categorie
     * @Route(
     *     path="/category/{slug}",
     *     name="category_articles",
     *     methods={"GET"},
     *     defaults={"slug":"computing"},
     *     requirements={"slug":"\w+"}
     *     )
     * @param $slug
     * @return Response
     */
    public function index($slug)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(["slug" => $slug]);

        if ($category === null) {
            return $this->redirectToRoute('home', $this->parameters, Response::HTTP_MOVED_PERMANENTLY);
        }

        # /categorie/une-formation-symfony-a-paris_8796456.html
//        return new Response("<html><body><h1>Page d'accueil : $category</h1></body></html>");
        return $this->render( 'controllers/index/category.html.twig', [ 'category' => $category] );
    }

}