<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Handler\MenuRequestHandler;
use App\Repository\MenuRepository;
use App\Request\MenuRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu")
 */
class MenuController extends Controller
{
    /**
     * @Route("/", name="menu_index", methods="GET")
     * @param MenuRepository $menuRepository
     * @return Response
     */
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('controllers/menu/index.html.twig', ['menus' => $menuRepository->findAll()]);
    }

    /**
     * @Route("/new", name="menu_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request ): Response
    {
        $menu = new Menu();
        $menuRequest = new MenuRequest();

        $form = $this->createForm(MenuType::class, $menuRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
//            $menu = $menuRequestHandler->handle($menuRequest);

            # Message FLash
            $this->addFlash('notice', 'Le menu a été créé avec succès');

            return $this->redirectToRoute('menu_index');
        }

        return $this->render('controllers/menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menu_show", methods="GET")
     * @param Menu $menu
     * @return Response
     */
    public function show(Menu $menu): Response
    {
        return $this->render('controllers/menu/show.html.twig', ['menu' => $menu]);
    }

    /**
     * @Route("/{id}/edit", name="menu_edit", methods="GET|POST")
     * @param Request $request
     * @param Menu $menu
     * @return Response
     */
    public function edit(Request $request, Menu $menu): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_edit', ['id' => $menu->getId()]);
        }

        return $this->render('controllers/menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menu_delete", methods="DELETE")
     * @param Request $request
     * @param Menu $menu
     * @return Response
     */
    public function delete(Request $request, Menu $menu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($menu);
            $em->flush();
        }

        return $this->redirectToRoute('menu_index');
    }
}
