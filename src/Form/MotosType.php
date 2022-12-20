<?php

namespace App\Form;

use App\Entity\Motos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class MotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Description', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff')))
            ->add('Kilometrage')
            ->add('Prix')
            ->add('DateImmat')
            ->add('Puissance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Motos::class,
        ]);
    }
}
