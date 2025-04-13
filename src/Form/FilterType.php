<?php
// src/Form/StageFilterType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Metier', ChoiceType::class, [
                'required' => false,
                'label' => 'Métier',
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
            ->add('departement', ChoiceType::class, [
                'required' => false,
                'label' => 'Département',    
                'choices' => [
                    'Partout' => '',
                    'Auvergne' => [
                        'Allier (03)' => 'Allier',
                        'Cantal (15)' => 'Cantal',
                        'Haute-Loire (43)' => 'Haute-Loire',
                        'Puy-de-Dôme (63)' => 'Puy-de-Dôme',
                    ],
                    'Bourgogne' => [
                        'Côte-d\'Or (21)' => 'Côte-d\'Or',
                        'Nièvre (58)' => 'Nièvre',
                        'Saône-et-Loire (71)' => 'Saône-et-Loire',
                        'Yonne (89)' => 'Yonne',
                    ],
                    'Bretagne' => [
                        'Côtes-d\'Armor (22)' => 'Côtes-d\'Armor',
                        'Finistère (29)' => 'Finistère',
                        'Ille-et-Vilaine (35)' => 'Ille-et-Vilaine',
                        'Morbihan (56)' => 'Morbihan',
                    ],
                    'Centre-Val de Loire' => [
                        'Cher (18)' => 'Cher',
                        'Eure-et-Loir (28)' => 'Eure-et-Loir',
                        'Indre (36)' => 'Indre',
                        'Indre-et-Loire (37)' => 'Indre-et-Loire',
                        'Loir-et-Cher (41)' => 'Loir-et-Cher',
                        'Loiret (45)' => 'Loiret',
                    ],
                    'Corse' => [
                        'Corse-du-Sud (2A)' => 'Corse-du-Sud',
                        'Haute-Corse (2B)' => 'Haute-Corse',
                    ],
                    'Grand Est' => [
                        'Ardennes (08)' => 'Ardennes',
                        'Aube (10)' => 'Aube',
                        'Marne (51)' => 'Marne',
                        'Haute-Marne (52)' => 'Haute-Marne',
                        'Meurthe-et-Moselle (54)' => 'Meurthe-et-Moselle',
                        'Meuse (55)' => 'Meuse',
                        'Moselle (57)' => 'Moselle',
                        'Bas-Rhin (67)' => 'Bas-Rhin',
                        'Haut-Rhin (68)' => 'Haut-Rhin',
                        'Vosges (88)' => 'Vosges',
                    ],
                    'Hauts-de-France' => [
                        'Aisne (02)' => 'Aisne',
                        'Nord (59)' => 'Nord',
                        'Oise (60)' => 'Oise',
                        'Pas-de-Calais (62)' => 'Pas-de-Calais',
                        'Somme (80)' => 'Somme',
                    ],
                    'Île-de-France' => [
                        'Paris (75)' => 'Paris',
                        'Seine-et-Marne (77)' => 'Seine-et-Marne',
                        'Yvelines (78)' => 'Yvelines',
                        'Essonne (91)' => 'Essonne',
                        'Hauts-de-Seine (92)' => 'Hauts-de-Seine',
                        'Seine-Saint-Denis (93)' => 'Seine-Saint-Denis',
                        'Val-de-Marne (94)' => 'Val-de-Marne',
                        'Val-d\'Oise (95)' => 'Val-d\'Oise',
                    ],
                    'Normandie' => [
                        'Calvados (14)' => 'Calvados',
                        'Eure (27)' => 'Eure',
                        'Manche (50)' => 'Manche',
                        'Orne (61)' => 'Orne',
                        'Seine-Maritime (76)' => 'Seine-Maritime',
                    ],
                    'Nouvelle-Aquitaine' => [
                        'Charente (16)' => 'Charente',
                        'Charente-Maritime (17)' => 'Charente-Maritime',
                        'Corrèze (19)' => 'Corrèze',
                        'Creuse (23)' => 'Creuse',
                        'Dordogne (24)' => 'Dordogne',
                        'Gironde (33)' => 'Gironde',
                        'Landes (40)' => 'Landes',
                        'Lot-et-Garonne (47)' => 'Lot-et-Garonne',
                        'Pyrénées-Atlantiques (64)' => 'Pyrénées-Atlantiques',
                        'Deux-Sèvres (79)' => 'Deux-Sèvres',
                        'Vienne (86)' => 'Vienne',
                        'Haute-Vienne (87)' => 'Haute-Vienne',
                    ],
                    'Occitanie' => [
                        'Ariège (09)' => 'Ariège',
                        'Aude (11)' => 'Aude',
                        'Aveyron (12)' => 'Aveyron',
                        'Gard (30)' => 'Gard',
                        'Haute-Garonne (31)' => 'Haute-Garonne',
                        'Gers (32)' => 'Gers',
                        'Hérault (34)' => 'Hérault',
                        'Lot (46)' => 'Lot',
                        'Lozère (48)' => 'Lozère',
                        'Hautes-Pyrénées (65)' => 'Hautes-Pyrénées',
                        'Pyrénées-Orientales (66)' => 'Pyrénées-Orientales',
                        'Tarn (81)' => 'Tarn',
                        'Tarn-et-Garonne (82)' => 'Tarn-et-Garonne',
                    ],
                    'Pays de la Loire' => [
                        'Loire-Atlantique (44)' => 'Loire-Atlantique',
                        'Maine-et-Loire (49)' => 'Maine-et-Loire',
                        'Mayenne (53)' => 'Mayenne',
                        'Sarthe (72)' => 'Sarthe',
                        'Vendée (85)' => 'Vendée',
                    ],
                    'Provence-Alpes-Côte d\'Azur' => [
                        'Alpes-de-Haute-Provence (04)' => 'Alpes-de-Haute-Provence',
                        'Hautes-Alpes (05)' => 'Hautes-Alpes',
                        'Alpes-Maritimes (06)' => 'Alpes-Maritimes',
                        'Bouches-du-Rhône (13)' => 'Bouches-du-Rhône',
                        'Var (83)' => 'Var',
                        'Vaucluse (84)' => 'Vaucluse',
                    ],
                    'Outre-Mer' => [
                        'Guadeloupe (971)' => 'Guadeloupe',
                        'Martinique (972)' => 'Martinique',
                        'Guyane (973)' => 'Guyane',
                        'La Réunion (974)' => 'La Réunion',
                        'Mayotte (976)' => 'Mayotte',
                    ],
                ],
                'placeholder' => 'Sélectionnez un département',
                'attr' => ['class' => 'form-select'],
            ]);
              // Ajouter le champ 'periode' seulement si l'option 'include_periode' est true
              if ($options['include_periode']) {
                $builder->add('periode', ChoiceType::class, [
                    'required' => false,
                    'label' => 'Période ',
                    'choices' => [
                        'Toutes' => '',
                        'Octobre-Décembre' => 'Octobre-Décembre',
                        'Janvier-Mars' => 'Janvier-Mars',
                        'Avril-Juillet' => 'Avril-Juillet',
                    ],
                    'placeholder' => 'Sélectionnez une période',
                    'attr' => ['class' => 'form-select'],
                ]);
            }
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'method' => 'GET', // pour utiliser la méthode GET pour envoyer les filtres
            'include_periode' => false, // Ajoutez une valeur par défaut pour l'option 'include_periode'
        ]);
    }
}
