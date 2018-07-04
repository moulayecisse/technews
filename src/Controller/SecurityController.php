<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 02/07/2018
 * Time: 10:38
 */

namespace App\Controller;


use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route( "/connexion", name="security_login" )
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        /**
         * Si notre utilisateur est déjà authentifié
         * on le redirige sue la page d'accueil
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