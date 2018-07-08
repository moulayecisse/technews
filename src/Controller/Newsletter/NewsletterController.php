<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 03/07/2018
 * Time: 11:40
 */

namespace App\Controller\Newsletter;


use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsletterController extends Controller
{
    /**
     * Affichage d'une Modale Newsletter
     */
    public function newsletter()
    {
        # Récupération du foormulaire
        $form = $this->createForm( \App\Form\NewsletterType::class );

        # Affichage de la Newsletter
        return $this->render
        (
            'controllers/newsletter/_modal.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}