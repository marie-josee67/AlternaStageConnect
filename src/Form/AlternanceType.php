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
            ->add('metier', ChoiceType::class, [
                'label' => 'Métier *',
                'required' => true,
                'choices' => [
                    
                    'Informatique et Numérique' => [
                        'Développeur' => 'Developpeur',
                        'Développeur Full Stack' => 'Developpeur Full Stack',
                        'Développeur Front-End' => 'Developpeur Front-End',
                        'Développeur Back-End' => 'Developpeur Back-End',
                        'Administrateur Systèmes et Réseaux' => 'Administrateur Systèmes et Réseaux',
                        'Ingénieur DevOps' => 'Ingénieur DevOps',
                        'Data Scientist' => 'Data Scientist',
                        'Analyste Cybersécurité' => 'Analyste Cybersécurité',
                        'UX/UI Designer' => 'UX/UI Designer',
                        'Chef de Projet IT' => 'Chef de Projet IT',
                        'Administrateur de Base de Données' => 'Administrateur de Base de Données',
                        'Développeur Mobile' => 'Développeur Mobile',
                        'Ingénieur Logiciel' => 'Ingénieur Logiciel',
                        'Testeur QA' => 'Testeur QA',
                        'Expert en Blockchain' => 'Expert en Blockchain',
                        'Consultant en Cybersécurité' => 'Consultant en Cybersécurité',
                    ],

                    'BTP et Construction' => [
                        'Architecte' => 'Architecte',
                        'Maçon' => 'Maçon',
                        'Électricien' => 'Électricien',
                        'Plombier' => 'Plombier',
                        'Ingénieur en BTP' => 'Ingénieur en BTP',
                        'Conducteur de Travaux' => 'Conducteur de Travaux',
                        'Charpentier' => 'Charpentier',
                        'Urbaniste' => 'Urbaniste',
                        'Ingénieur Géotechnique' => 'Ingénieur Géotechnique',
                        'Conducteur de Travaux Publics' => 'Conducteur de Travaux Publics',
                        'Chef de Chantier' => 'Chef de Chantier',
                        'Ingénieur Électrique' => 'Ingénieur Électrique',
                        'Technicien en Maintenance' => 'Technicien en Maintenance',
                    ],

                    'Santé et Paramédical' => [
                        'Médecin Généraliste' => 'Médecin Généraliste',
                        'Infirmier' => 'Infirmier',
                        'Chirurgien' => 'Chirurgien',
                        'Pharmacien' => 'Pharmacien',
                        'Sage-Femme' => 'Sage-Femme',
                        'Kinésithérapeute' => 'Kinésithérapeute',
                        'Psychologue' => 'Psychologue',
                        'Médecin Spécialiste' => 'Médecin Spécialiste',
                        'Chirurgien-dentiste' => 'Chirurgien-dentiste',
                        'Orthophoniste' => 'Orthophoniste',
                        'Opticien-Lunetier' => 'Opticien-Lunetier',
                        'Dentiste' => 'Dentiste',
                    ],

                    'Commerce et Vente' => [
                        'Commercial' => 'Commercial',
                        'Représentant des Ventes' => 'Représentant des Ventes',
                        'Responsable de Magasin' => 'Responsable de Magasin',
                        'Chargé de Clientèle' => 'Chargé de Clientèle',
                        'Directeur Commercial' => 'Directeur Commercial',
                        'Agent Immobilier' => 'Agent Immobilier',
                        'Assistant Commercial' => 'Assistant Commercial',
                        'Responsable Marketing' => 'Responsable Marketing',
                        'Chef de Rayon' => 'Chef de Rayon',
                        'Vendeur en ligne' => 'Vendeur en ligne',
                        'Négociant' => 'Négociant',
                    ],

                    'Industrie et Production' => [
                        'Technicien de Production' => 'Technicien de Production',
                        'Opérateur de Machine' => 'Opérateur de Machine',
                        'Soudeur' => 'Soudeur',
                        'Ingénieur en Production' => 'Ingénieur en Production',
                        'Mécanicien Industriel' => 'Mécanicien Industriel',
                        'Ingénieur Mécanique' => 'Ingénieur Mécanique',
                        'Technicien en Maintenance Industrielle' => 'Technicien en Maintenance Industrielle',
                        'Ingénieur Environnement' => 'Ingénieur Environnement',
                        'Conducteur de ligne de production' => 'Conducteur de ligne de production',
                        'Chargé d\'études industrielles' => 'Chargé d\'études industrielles',
                    ],

                    'Transport et Logistique' => [
                        'Chauffeur Routier' => 'Chauffeur Routier',
                        'Livreur' => 'Livreur',
                        'Magasinier' => 'Magasinier',
                        'Responsable Logistique' => 'Responsable Logistique',
                        'Pilote de Ligne' => 'Pilote de Ligne',
                        'Logisticien' => 'Logisticien',
                        'Chef de Parc' => 'Chef de Parc',
                        'Responsable Transport' => 'Responsable Transport',
                        'Technicien en Logistique' => 'Technicien en Logistique',
                        'Pilote de Drone' => 'Pilote de Drone',
                    ],

                    'Hôtellerie et Restauration' => [
                        'Chef Cuisinier' => 'Chef Cuisinier',
                        'Serveur' => 'Serveur',
                        'Réceptionniste' => 'Réceptionniste',
                        'Pâtissier' => 'Pâtissier',
                        'Sommelier' => 'Sommelier',
                        'Barman' => 'Barman',
                        'Responsable des Ressources Humaines (Hôtellerie)' => 'Responsable des Ressources Humaines (Hôtellerie)',
                        'Directeur d’Hôtel' => 'Directeur d’Hôtel',
                    ],

                    'Communication et Marketing' => [
                        'Chargé de Communication' => 'Chargé de Communication',
                        'Community Manager' => 'Community Manager',
                        'Chef de Produit' => 'Chef de Produit',
                        'SEO Manager' => 'SEO Manager',
                        'Graphiste' => 'Graphiste',
                        'Publicitaire' => 'Publicitaire',
                        'Spécialiste en Publicité' => 'Spécialiste en Publicité',
                        'Directeur Marketing' => 'Directeur Marketing',
                        'Photographe' => 'Photographe',
                        'Rédacteur Web' => 'Rédacteur Web',
                        'Influenceur' => 'Influenceur',
                        'Chef de Produit Digital' => 'Chef de Produit Digital',
                    ],

                    'Éducation et Formation' => [
                        'Professeur des Écoles' => 'Professeur des Écoles',
                        'Formateur' => 'Formateur',
                        'Éducateur Spécialisé' => 'Éducateur Spécialisé',
                        'Moniteur' => 'Moniteur',
                        'Animateur Périscolaire' => 'Animateur Périscolaire',
                        'Coach en Développement Personnel' => 'Coach en Développement Personnel',
                        'Formateur en Entreprise' => 'Formateur en Entreprise',
                        'Psychopédagogue' => 'Psychopédagogue',
                    ],

                    'Juridique et Administratif' => [
                        'Avocat' => 'Avocat',
                        'Notaire' => 'Notaire',
                        'Secrétaire Administratif' => 'Secrétaire Administratif',
                        'Juriste' => 'Juriste',
                        'Huissier de Justice' => 'Huissier de Justice',
                        'Greffier' => 'Greffier',
                        'Conseiller en Propriété Industrielle' => 'Conseiller en Propriété Industrielle',
                        'Avocat en Droit des Affaires' => 'Avocat en Droit des Affaires',
                        'Notaire Assistant' => 'Notaire Assistant',
                        'Administrateur Judiciaire' => 'Administrateur Judiciaire',
                    ],

                    'Agriculture et Environnement' => [
                        'Agriculteur' => 'Agriculteur',
                        'Vigneron' => 'Vigneron',
                        'Ingénieur Agronome' => 'Ingénieur Agronome',
                        'Technicien de l\'Environnement' => 'Technicien de l\'Environnement',
                        'Écologiste' => 'Écologiste',
                        'Technicien en Agriculture Biologique' => 'Technicien en Agriculture Biologique',
                        'Garde Forestier' => 'Garde Forestier',
                        'Spécialiste en Gestion des Ressources Naturelles' => 'Spécialiste en Gestion des Ressources Naturelles',
                    ],

                    'Sport et Animation' => [
                        'Coach Sportif' => 'Coach Sportif',
                        'Animateur' => 'Animateur',
                        'Éducateur Sportif' => 'Éducateur Sportif',
                        'Préparateur Physique' => 'Préparateur Physique',
                        'Entraîneur Sportif' => 'Entraîneur Sportif',
                        'Moniteur de Ski' => 'Moniteur de Ski',
                        'Kinésithérapeute Sportif' => 'Kinésithérapeute Sportif',
                    ],

                    'Autre' => [
                        'Autre' => 'autre'
                    ]
                ],
                'placeholder' => 'Choisissez un métier',
            ])
            
            ->add('img', FileType::class, [
                'label' => 'Image de l\'annonce (JPG, PNG, WEBP)',
                'mapped' => false, // pas lié directement à l'entité
                'required' => false,
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
