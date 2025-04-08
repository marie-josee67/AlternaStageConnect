<?php

namespace App\Form;

use App\Entity\Postuler;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostulerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('prenom')
            ->add('adresse')
            ->add('codePostale')
            ->add('email')
            ->add('Cv')
            ->add('lettreMotivation')
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Postuler::class,
        ]);
    }
}
