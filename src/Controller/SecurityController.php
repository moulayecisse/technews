<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 02/07/2018
 * Time: 10:38
 */

namespace App\Controller;


use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route( "/connexion", name="security_login" )
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     */
    public function login( Request $request, AuthenticationUtils $authenticationUtils )
    {
        /**
         * Si notre utilisateur est déjà authentifié
         * on le rédirige sue la page d'accueil
         */
        if( $this->getUser() ) return $this->redirectToRoute( 'home' );

        #Récupération du formulaire
        $form = $this->createForm(
            LoginType::class,
            ['email' => $authenticationUtils->getLastAuthenticationError()]
        );

        # Transmition à la vue
        return $this->render(
            'controllers/security/login.html.twig',
            [
                'form' => $form->createView(),
                'error'         => $authenticationUtils->getLastAuthenticationError()
            ]
        );
    }

    /**
     * @Route( "deconnexion", name="security_logout" )
     */
    public function logout()
    {
    }

    /**
     * Vous pourriez définir aussi ici,
     * votre logique, mot de passe oublié
     * reinitialisation du mot de passe
     * Email de validation
     */
}