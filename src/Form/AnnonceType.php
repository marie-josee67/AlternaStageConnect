<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filname', TextType::class,[
                'label' => "Nom de l'annonce"
            ])
            ->add('date', null, [
                'widget' => 'single_text',
                'label' => "Date de l'annonce"
            ])
            ->add('description', null, [
                'label'=>"Description de l'offre"
            ])
            
            // ajout du bouton
            ->add('submit', SubmitType::class, [
                'label'=> 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
