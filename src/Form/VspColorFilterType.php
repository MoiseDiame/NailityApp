<?php

namespace App\Form;

use App\Entity\VspColor;
use App\SearchClasses\VspColorFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VspColorFilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('coloris', EntityType::class, [
                'required' => false,
                'label' => 'Trier par coloris',
                'class' => VspColor::class,
                'multiple' => true,
                'expanded' => true,
                'label_attr' => [
                    'class' => 'checkbox-inline'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Filtrer',
                'attr' => [
                    "class" => 'btn btn-primary inline-block'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => VspColorFilter::class,
            'method' => 'GET',
            'crsf_protection' => false
        ]);
    }
}
