<?php

namespace App\Form;

use App\Entity\StoreName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoreNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('about')
            ->add('description')
            ->add('logo')
            ->add('carsoule1')
            ->add('carsoule2')
            ->add('carsoule3')
            ->add('updatedAt')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StoreName::class,
        ]);
    }
}
