<?php

namespace App\Controller;

use DateTime;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use APP\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $annonceRepository = $entityManager->getRepository(Annonce::class);
        $annonces = $annonceRepository->findAll();

        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    #[Route('/annonce/create', name: 'app_annonce_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        // création de l'objet
        $annonce = new Annonce();

        // création du formulaire pour l'affichage
        //@param AnnonceType : correspond à la classe du formulaire
        // @param $annonce : l'objet qui sera remplit par le formulaire
        $formAnnonceCreate = $this->createForm(AnnonceType::class,$annonce);

        // // définir les différent attributs de l'objet
        // $annonce->setDescription("annonce 1")
        //         ->setDate(new DateTime())
        //         ->setFilname("fichier.img");

        // // prépare les données à être sauvegarder en base
        // $entityManager->persist($annonce);

        // //enregistre les données en base et créer l'Id unique
        // $entityManager->flush();
        return $this->render('annonce/create.html.twig', [
            'formCreate' => $formAnnonceCreate,
            'annonce'=>$annonce
        ]);
    }
}
