<?php

namespace App\Form;

use App\Entity\Menu;
use App\Request\MenuRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add( 'route' )
            ->add
            (
                'isPublished',
                CheckboxType::class,
                [
                    'required' => false,
                    'label'    => false,
                    'attr'     => [
                        'class' => 'col-sm-4 col-md-3',
                        'data-toggle' => 'toggle',
                        'data-on'     => 'published',
                        'data-off'    => 'unpublished',
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MenuRequest::class,
        ]);
    }
}
