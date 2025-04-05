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
            ->add('titre', null, [
                'label'=>"Titre de l'annonce *"
            ])
            ->add('metier', null, [
                'label'=>"Métier *"
            ])
            ->add('img', null, [
                'label'=>"Image *"
            ])
            ->add('date_debut', null, [
                'widget' => 'single_text',
                'label' => "Date de début *"
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
                'label' => "Date de fin *"
            ])
            ->add('date_ouverture', null, [
                'widget' => 'single_text',
            ])
            ->add('date_cloture', null, [
                'widget' => 'single_text',
            ])
            ->add('description', null, [
                'label'=>"Description de l'offre *"
            ])
            ->add('mission', null, [
                'label'=>"Missions *"
            ])
            ->add('processus')
            ->add('annee_experience', null, [
                'label'=>"Année(s) d'expérience *"
            ])
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
