<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 03/07/2018
 * Time: 11:35
 */

namespace App\Form;


use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add
            (
                'email',
                EmailType::class,
                [
                    'label' => false,
                    'attr' =>
                    [
                        'placeholder' => 'Saisissez votre Email'
                    ],
                ]
            )
            ->add
            (
                'submit',
                SubmitType::class,
                [
                    'label' => 'Je m\'inscris !'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Newsletter::class);
    }

}