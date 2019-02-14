<?php

namespace App\Form;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom_ingredient', TextType::class, array('label' => false))
                ->add('suppr', ButtonType::class, [
                    'attr' => [
                        'class' => 'remove-collection-widget btn btn-outline-warning',
                        'data-list' => '#ingredient-fields-list',
                        'style' => 'font-weight: bold; height: 30px; line-height:10px; margin-left:10px;'
                    ],
                ]);
    }
	
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ingredient::class,
        ));
    }
}