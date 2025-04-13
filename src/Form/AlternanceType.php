<?php

namespace App\Form;

use App\Entity\Alternance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlternanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', null, [
                'label'=>"Titre de l'annonce *",
                'required' => true, // champ obligatoire
            ])
            
            ->add('img', FileType::class, [
                'label' => 'Image de l\'annonce (JPG, PNG, WEBP) *',
                'mapped' => false, // pas lié directement à l'entité
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez envoyer une image valide (jpg, png, webp)',
                    ])
                ],
                'attr' => [
                    'accept' => '.jpg,.jpeg,.png,.webp',
                ],
            ])
            ->add('date_debut', null, [
                'widget' => 'single_text',
                'label' => "Date de début *",
                'required' => true, 
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
                'label' => "Date de fin *",
                'required' => true, 
            ])
            ->add('date_ouverture', null, [
                'widget' => 'single_text',
            ])
            ->add('date_cloture', null, [
                'widget' => 'single_text',
            ])
            ->add('description', null, [
                'label'=>"Description de l'offre *",
                'required' => true, 
            ])
            ->add('mission', null, [
                'label'=>"Missions *",
                'required' => true, 
            ])
            ->add('processus',null,[
                'label'=>"Processus de recrutement",
            ])
            ->add('annee_experience', null, [
                'label'=>"Année(s) d'expérience *",
                'required' => true, 
            ])
            ->add('reconversible', null, [
                'label'=>"Appel d'offre renouvelable *",
                'required' => false, 
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
            'data_class' => Alternance::class,
        ]);
    }
}
