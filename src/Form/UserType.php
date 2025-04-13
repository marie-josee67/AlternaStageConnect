<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])

            ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'required' => false,  // rendre non obligatoire
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Laisse vide pour ne pas modifier',
                    'autocomplete' => 'Nouveau mot de passe'
                ],
                'constraints' => [
                    // Appliquer la contrainte uniquement si le mot de passe est saisi
                    new Length([
                        'min' => 16,
                        'minMessage' => 'Le mot de passe doit avoir au minimum {{ limit }} caractères pour être bien sécurisé',
                        'max' => 4096,
                    ]),
                ],
            ])
            
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le mot de passe',
                'mapped' => false, // ce champ n'est pas lié à l'entité
                'required' => false, // rendre non obligatoire
                'empty_data' => '', // le champ peut être vide
                'attr' => ['placeholder' => 'Confirmez votre mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci de confirmer votre mot de passe",
                    ]),
                ],
            ]);

    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

