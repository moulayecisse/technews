<?php

namespace App\Controller\User;


use App\Form\UserType;
use App\Handler\UserRequestHandler;
use App\Request\UserRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * Inscription d'un Utilisateur
     * @Route("/inscription",
     *     name="user_register",
     *     methods={"GET", "POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request)
    {
        # Création d'un nouvel utilisateur
        $user = new UserRequest();

        # Création du Formulaire
        $form = $this->createForm(UserType::class, $user)
            ->handleRequest($request);

        # Vérification et Traitement du Formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            # Enregistrement de l'utilisateur
//            $user = $userRequestHandler->registerAsUser($user);

            # Flash Messages
            $this->addFlash('notice','Félicitation, vous pouvez vous connecter !');

            # Redirection
            return $this->redirectToRoute('home');

        }

        # Affichage du Formulaire dans la vue
        return $this->render
        (
            'controllers/user/register.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
