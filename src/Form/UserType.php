<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 29/06/2018
 * Time: 08:33
 */

namespace App\Form;


use App\Request\UserRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            #Ajout du champ prénom
            ->add(
                'firstName',
                TextType::class,
                [
                    'required' => true,
                    'label'    => 'Ton prénom',
                    'attr'     =>
                        [
                            'placeholder' => 'Ton prénom'
                        ],
                ]
            )

            #Ajout du champ nom
            ->add(
                'lastName',
                TextType::class,
                [
                    'required' => true,
                    'label'    => 'Ton nom',
                    'attr'     =>
                        [
                            'placeholder' => 'Ton nom'
                        ],
                ]
            )

            #Ajout du champ mail
            ->add(
                'email',
//                TextareaType::class,
                EmailType::class,
                [
                    'required' => true,
                    'label'    => 'Ton email',
                    'attr'     =>
                        [
                            'placeholder' => 'Ton email'
                        ],
                ]
            )

            #Ajout de champ password
            ->add(
                'password',
//                TextareaType::class,
                PasswordType::class,
                [
                    'required' => true,
                    'label'    => 'Ton password',
                    'attr'     =>
                        [
                            'placeholder' => 'Ton password'
                        ],
                ]
            )

            ->add('conditions', CheckboxType::class, ['label' => "J'accepte les Conditions Générales d'Utilisation"])

            #Ajout de champ catégories
            ->add( 'submit', SubmitType::class, [ 'label'    => 'Je m\'inscris' ] );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                //'data_class' => Article::class
                'data_class' => UserRequest::class
            ]
        );
    }
}