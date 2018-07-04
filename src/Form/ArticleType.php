<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 29/06/2018
 * Time: 15:57
 */

namespace App\Form;

use App\Entity\Category;
use App\Request\ArticleRequest;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            #Ajout de champ title
            ->add(
                'title',
                TextType::class,
                [
                    'required' => true,
                    'label'    => 'Titre de l\'article',
                    'attr'     =>
                        [
                            'placeholder' => 'Titre de l\'article'
                        ],
                ]
            )

            #Ajout de champ catégories
            ->add(
                'category',
                EntityType::class,
                [
                    'class'        => Category::class,
                    'choice_label' => 'name',
                    //                    'choice_label' => function ($category) {return $category->getName();},
                    'required' => true,
                    //                    'attr'     =>
                    //                    [
                    //                        'placeholder' => 'Titre de l\'article'
                    //                    ],
                ]
            )

            #Ajout de champ catégories
            ->add(
                'content',
//                TextareaType::class,
                CKEditorType::class,
                [
                    'required' => true,
                    'label'    => 'Contenu de l\'article',
                    'attr'     =>
                        [
                            'placeholder' => 'Contenu de l\'article',
                            //                        'id' => 'editor'
                        ],
                ]
            )

            #Ajout de champ catégories
            ->add(
                'featuredImage',
                FileType::class,
//                TextType::class,
                [
                    'required' => false,
                    'label'    => false,
                    'attr'     =>
                        [
                            'class' => 'dropify',
                            'data-default-file' => $options['image_url'],
//                            'data-default-file' => 'http://127.0.0.1:8000/images/product/un-accord-sur-les-migrations-trouve-lors-du-sommet-de-lunion-europeenne.jpeg',
                        ],
                ]
            )

            #Ajout de champ special
            ->add(
                'special',
                CheckboxType::class,
                [
                    'required' => false,
                    'label'    => 'Est en spécial',
                    'attr'     => [
                        'data-toggle' => 'toggle',
                        'data-on'     => 'oui',
                        'data-off'    => 'non',
                    ]
                ]
            )

            #Ajout de champ spotlight
            ->add(
                'spotlight',
                CheckboxType::class,
                [
                    'required' => false,
                    'label'    => 'Est en spotlight',
                    'attr'     => [
                        'data-toggle' => 'toggle',
                        'data-on'     => 'oui',
                        'data-off'    => 'non',
                    ]
                ]
            )

            #Ajout de champ catégories
            ->add( 'save', SubmitType::class, [ 'label'    => 'Publier', ] );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
//                'data_class' => Article::class
                'data_class' => ArticleRequest::class,
                'image_url' => '',
            ]
        );
    }
}