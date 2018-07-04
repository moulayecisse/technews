<?php
namespace App\Controller\Article;

use App\Controller\BaseController;
use App\Controller\HelperTrait;
use App\Entity\Article;
use App\Article\ArticleRequestFactory;
use App\Article\ArticleType;
use App\Handler\ArticleRequestHandler;
use App\Handler\ArticleRequestUpdateHandler;
use App\Article\ArticleRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ArticleController
 * @Route("/article")
 * @package App\Controller\Article
 */
class ArticleController extends BaseController
{
    use HelperTrait;

    /**
     * @Route(path="/new", name="article_add")
     * @Security("has_role('ROLE_AUTHOR')")
     * @param Request $request
     * @param ArticleRequestHandler $articleRequestHandler
     * @return mixed
     */
    public function new( Request $request, ArticleRequestHandler $articleRequestHandler )
    {
        $this->view = 'article/add.html.twig';

        # Récupération de l'auteur depuis la repository
//        $author = $this->getDoctrine()
//            ->getRepository( User::class )
//            ->find( rand(1, 3) );

        # Création d'un nouvel article
        $articleRequest = new ArticleRequest($this->getUser());

        # Créer un formulaire permettant l'ajout d'un Article
        $form = $this->createForm( ArticleType::class, $articleRequest );

        # Traitement des donnés POST
        $form->handleRequest($request);

        # Vérification des donnés du Formulaire
        if( $form->isSubmitted() && $form->isValid() ){
            /**
             * Une fois le formulaire soumit et valide,
             * on passe nos données directement au service
             * qui se chargera du traitement.
             */
            $article = $articleRequestHandler->handle($articleRequest);

            # Message FLash
            $this->addFlash('notice', 'Félicitation votre article est en ligne');

            $this->parameters['category'] = $article->getCategory()->getSlug();
            $this->parameters['slug']     = $article->getSlug();
            $this->parameters['id']       = $article->getId();

            # Redirection sur l'article qui vient d'être créé
            return $this->redirectToRoute( 'category_articles', $this->parameters );
        }

        $this->parameters['form'] = $form->createView();


        # Affichage du formulaire dans la vue
        return $this->render( 'controllers/article/add.html.twig', $this->parameters );
    }

    /**
     * Affiche les category d'une catégorie
     * @Route(
     *     path="/{category}/{slug}_{id}.html",
     *     name="article_show",
     *     methods={"GET"},
     *     requirements={"id":"\d+"}
     *     )
     * @param Article $article
     * @return Response
     */
    public function show(Article $article)
    {
        if ($article === null) {
            return $this->redirectToRoute('home', $this->parameters, Response::HTTP_MOVED_PERMANENTLY);
        }

        return $this->render( 'controllers/article/show.twig', [ 'article' => $article ] );
    }

    /**
     * Affiche les category d'une catégorie
     * @Route(
     *     path="/edit/{id}",
     *     name="article_edit",
     *     methods={"GET", "POST"},
     *     requirements={"id":"\d+"}
     *     )
     * @Security("has_role('ROLE_AUTHOR')")
     * @param Request $request
     * @param ArticleRequestUpdateHandler $articleRequestUpdateHandler
     * @param Article $article
     * @param Packages $packages
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function edit(Request $request, ArticleRequestUpdateHandler $articleRequestUpdateHandler, Article $article, Packages $packages)
    {
//        dump($article);

//        $articleRequestFactory = new ArticleRequestFactory();

        # Création d'un nouvel article
        $articleRequest = ArticleRequestFactory::createFromArticle($article, $packages, $this->getParameter('article_image_path'));

        if( $articleRequest == null ) $articleRequest = new ArticleRequest($this->getUser());

        # Créer un formulaire permettant l'ajout d'un Article
        $form = $this->createForm
        (
            ArticleType::class,
            $articleRequest,
            [
                'image_url' => $articleRequest->getFeaturedImageUrl()
            ]
        );

        # Traitement des donnés POST
        $form->handleRequest($request);

        # Vérification des donnés du Formulaire
        if( $form->isSubmitted() && $form->isValid() ){
            /**
             * Une fois le formulaire soumit et valide,
             * on passe nos données directement au service
             * qui se chargera du traitement.
             */
            $article = $articleRequestUpdateHandler->handle($articleRequest, $article);

            # Message FLash
            $this->addFlash('notice', 'Félicitation votre article à bien été modifié');

            # Redirection sur l'article qui vient d'être créé
            return $this->redirectToRoute( 'article_edit', ['id' => $article->getId() ] );
        }

//        $article->setFeaturedImage( new File( 'images/product/' . $article->getFeaturedImage() ) );
        $article->setFeaturedImage( '/images/product/' . $article->getFeaturedImage() );

        $this->parameters['article']  = $article;

        $this->parameters['form'] = $form->createView();

        return $this->render( 'controllers/article/edit.html.twig', $this->parameters );
    }
}