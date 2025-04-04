<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('Metier')
            ->add('title')
            ->add('date_creat', null, [
                'widget' => 'single_text',
            ])
            ->add('date_debut', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
            ])
            ->add('date_ouverture', null, [
                'widget' => 'single_text',
            ])
            ->add('date_cloture', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('mission')
            ->add('processus')
            ->add('annee_experience')
            ->add('reconversible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
