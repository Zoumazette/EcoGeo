<?php

namespace App\Form;

use App\Entity\Success;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuccessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('success_name')
            ->add('logo')
            ->add('success_level')
            ->add('created_at')
            ->add('created_by')
            ->add('updated_at')
            ->add('updated_by')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Success::class,
        ]);
    }
}
