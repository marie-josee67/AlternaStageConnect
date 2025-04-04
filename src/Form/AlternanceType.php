<?php

namespace App\Form;

use App\Entity\Alternance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlternanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('metier')
            ->add('img')
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
            // ajout du bouton
            ->add('submit', SubmitType::class, [
                'label'=> 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alternance::class,
        ]);
    }
}
