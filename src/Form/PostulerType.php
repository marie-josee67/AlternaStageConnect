<?php

namespace App\Form;

use App\Entity\Postuler;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PostulerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label'=>"Nom *",
                'required' => true, // champ obligatoire
            ])
            ->add('prenom', null, [
                'label'=>"Prénom *",
                'required' => true,
            ])
            ->add('adresse', null, [
                'label'=>"Adresse *",
                'required' => true,
            ])
            ->add('codePostale', null, [
                'label'=>"Code Postale *",
                'required' => true,
            ])
            ->add('email', null, [
                'label'=>"E-mail *",
                'required' => true,
            ])
            ->add('Cv', FileType::class, [
                'label'=>"CV *",
                'mapped' => false, //  pas stocker directement le fichier dans l'entité
                'required' => true,
                'attr' => ['accept' => '.pdf'],  // que les fichiers PDF
            ])
            ->add('lettreMotivation', FileType::class, [
                'label' => 'Lettre de Motivation (PDF)',
                'mapped' => false,  
                'required' => true,  
                'attr' => ['accept' => '.pdf'],  
            ])
            ->add('message', null, [
                'label'=>"Message",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Postuler::class,
        ]);
    }
}
